<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Ressource;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProcessVideoHlsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ressourceId;
    protected $mp4Path;

    //private $ffmpegPath = '/home/u948188746/ffmpeg/ffmpeg-7.0.2-amd64-static/ffmpeg';

    public function __construct($ressourceId, $mp4Path)
    {
        $this->ressourceId = $ressourceId;
        $this->mp4Path = $mp4Path;
    }

    public function handle()
    {
        $ressource = Ressource::find($this->ressourceId);
        if (!$ressource) {
            Log::error("ProcessVideoHlsJob failed: Ressource ID {$this->ressourceId} not found.");
            return;
        }

        $inputPath = Storage::disk('private')->path($this->mp4Path);
        $videoName = pathinfo($this->mp4Path, PATHINFO_FILENAME);
        $outputDir = storage_path("app/private/videos/{$videoName}_hls");
        $outputPath = $outputDir . "/index.m3u8";

        // ENHANCEMENT 3: Delete the old files *before* processing the new one (if the job is a replacement)
        $previousName = $ressource->getOriginal('video_url'); // Get the value *before* the update
        if ($previousName) {
            try {
                File::deleteDirectory(storage_path("app/private/videos/{$previousName}_hls"));
            } catch (\Exception $e) {
                Log::warning('Job failed to delete old HLS directory: ' . $e->getMessage());
            }
        }

        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0777, true);
        }

        // FFmpeg COMMAND: Use stream copy for speed (as corrected earlier)
        $process = new Process([
            'ffmpeg',
            '-i',
            $inputPath,
            // Video Codec: H.264 (libx264)
            '-c:v',
            'libx264',
            // Constant Rate Factor: 23 is default, 21 is higher quality
            '-crf',
            '21',
            // Preset: Controls speed vs. compression efficiency
            '-preset',
            'medium',
            // Audio Codec: AAC
            '-c:a',
            'aac',
            '-b:a',
            '128k', // 128 kbps audio bitrate

            // HLS Options
            '-hls_time',
            '10',
            '-hls_list_size',
            '0',
            '-f',
            'hls',
            $outputPath
        ]);

        try {
            $process->setTimeout(3600); // Allow up to 1 hour for large files
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // Optional: Delete the large original MP4 file after HLS is done
            if (Storage::disk('private')->exists($this->mp4Path)) {
                Storage::disk('private')->delete($this->mp4Path);
            }

            // Update the model to mark the video as processed (if needed, or just let it be)
            // The controller already set the base name, but you could add a 'status' field here.

        } catch (ProcessFailedException $e) {
            Log::error("FFmpeg HLS conversion failed for ID {$this->ressourceId}. Error: " . $e->getMessage());
            // Log::error("FFmpeg Output: " . $e->getOutput() . "\nError Output: " . $e->getErrorOutput());

            // CRITICAL: Delete the new, original uploaded MP4 if the conversion failed
            if (Storage::disk('private')->exists($this->mp4Path)) {
                Storage::disk('private')->delete($this->mp4Path);
            }

            // You might want to reset the video_url or set an error status on the model here
            $ressource->video_url = $previousName; // Revert to previous video if processing failed
            $ressource->save();
            throw $e; // Re-throw to mark the job as failed
        }
    }
}

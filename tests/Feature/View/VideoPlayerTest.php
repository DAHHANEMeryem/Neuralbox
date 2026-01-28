<?php

namespace Tests\Feature\View;

use Tests\TestCase;

class VideoPlayerTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $contents = $this->view('video-player', [
            //
        ]);

        $contents->assertSee('');
    }
}

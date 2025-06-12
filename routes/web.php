<?php

use App\Http\Controllers\CoursController;
use App\Http\Controllers\MeanController;
use App\Http\Controllers\NeuralBoxController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PolicyControllers;
use App\Http\Controllers\conditionsControllers;
use App\Http\Controllers\AboutusController; 
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\subscribeControllers; 
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\MessagesController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\RendezVousController;
use App\Http\Controllers\Admin\PaiementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminRendezVousController;
use App\Http\Controllers\Admin\RessourceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
// Routes pour la page d'information de paiement
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/confirmation/{id}', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');

Route::middleware(['auth', 'IsAdmin'])->group(function () {

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('ressources', RessourceController::class);
});



     Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/utilisateurs', [AdminUserController::class, 'index'])->name('admin.utilisateurs');
  Route::delete('/admin/utilisateurs/{id}', [AdminUserController::class, 'destroy'])->name('admin.utilisateurs.destroy');
  Route::get('/admin/rendezvous', [AdminRendezVousController::class, 'index'])->name('admin.rendezvous.index');
  Route::patch('/admin/rendezvous/{id}/statut', [AdminRendezVousController::class, 'updateStatut'])->name('admin.rendezvous.updateStatut');
  Route::get('/admin/rendezvous', [AdminRendezVousController::class, 'index'])
  ->name('admin.rendezvous.index');
  Route::get('/rendezvous/{id}', [RendezvousController::class, 'show'])->name('rendezvous.show');
  Route::get('/rendezvous/{id}/edit', [RendezvousController::class, 'edit'])->name('rendezvous.edit');
  
Route::put('/rendezvous/{id}', [RendezvousController::class, 'update'])->name('rendezvous.update');


Route::get('/admin/paiements', [PaiementController::class, 'index'])->name('admin.paiements');
  
// Mettre à jour le statut d'un rendez-vous (accepter/refuser)
Route::patch('/admin/rendezvous/{id}/update-status', [AdminRendezVousController::class, 'updateStatus'])
  ->name('admin.rendezvous.updateStatus');
  
// Récupérer les détails d'un rendez-vous (pour la modal)
Route::get('/admin/rendezvous/{id}/details', [AdminRendezVousController::class, 'getDetails'])
  ->name('admin.rendezvous.details');
  Route::delete('/admin/rendezvous/{id}', [AdminRendezVousController::class, 'destroy'])->name('admin.rendezvous.destroy');
  Route::get('/admin/rendezvous/{id}/edit-statut', [AdminRendezVousController::class, 'editStatutArrive'])->name('admin.rendezvous.updateStatut');
  Route::patch('/admin/rendezvous/{id}/update-statut', [AdminRendezVousController::class, 'updateStatutArrive'])->name('admin.rendezvous.saveStatut');
  
 
    Route::get('admin/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('admin/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('admin/messages/{id}/read', [App\Http\Controllers\Admin\MessageController::class, 'markAsRead'])->name('admin.messages.markAsRead');
    Route::delete('admin/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('admin.messages.destroy');
 
});


Route::middleware(['auth'])->group(function () {
    Route::get('/prendre-rendez-vous', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/prendre-rendez-vous', [RendezVousController::class, 'store'])->name('rendezvous.store');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



// Route protégée par middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
 


Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
// الصفحة الخاصة بالحساب
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])
    ->middleware(['auth'])
    ->name('account');

// صفحة السياسات
Route::get('/privacy-policy', [PolicyControllers::class, 'index'])->name('privacy-policy');

// صفحة الشروط
Route::get('conditions-utilisateur',[conditionsControllers::class, 'index'])->name('conditions-utilisateur');
Route::get('subscribe',[subscribeControllers::class, 'index'])->name('subscribe');

// الصفحة الرئيسية
Route::get('/', [MeanController::class, 'index'])->name('home');

// تغيير اللغة
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'fr'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
});



// باقي الروابط
Route::get('/video-url/{filename}', [CoursController::class, 'getVideoUrl']);
Route::get('/neuralbox', [NeuralBoxController::class, 'index'])->name('neuralbox');
Route::get('/peda', [NeuralBoxController::class, 'peda'])->name('peda');
Route::get('/suivre', [MeanController::class, 'suivre'])->name('suivre');
Route::get('/policy', [MeanController::class, 'suivre'])->name('suivre');
Route::get('/about', [AboutusController::class, 'about'])->name('about');

// المسار للفيديو
Route::get('/video/stream/{filename}', function ($filename) {
    // تحقق من التوقيع
    if (!request()->hasValidSignature()) {
        abort(403, 'Unauthorized or expired link.');
    }

    $disk = Storage::disk('local');
    $filePath = $disk->path('videos/' . $filename);

    // تأكد من وجود الملف
    if (!file_exists($filePath)) {
        abort(404, 'File not found.');
    }

    $fileSize = filesize($filePath);
    $start = 0;
    $length = $fileSize;
    $headers = [
        'Content-Type' => 'video/mp4',
        'Content-Length' => $fileSize,
        'Accept-Ranges' => 'bytes',
    ];

    if (request()->headers->has('Range')) {
        $range = request()->header('Range');
        list(, $range) = explode('=', $range, 2);
        list($start, $end) = explode('-', $range);

        $start = intval($start);
        $end = $end === '' ? $fileSize - 1 : intval($end);
        $length = $end - $start + 1;

        $headers['Content-Range'] = "bytes $start-$end/$fileSize";
        $headers['Content-Length'] = $length;

        // حالة المحتوى الجزئي
        $statusCode = 206;
    } else {
        // حالة المحتوى الكامل
        $statusCode = 200;
    }

    return response()->stream(function () use ($filePath, $start, $length) {
        $handle = fopen($filePath, 'rb');
        fseek($handle, $start);
        echo fread($handle, $length);
        fclose($handle);
    }, $statusCode, $headers);
})->name('video.stream');

// صفحة الداشبورد



// Route::middleware(['auth', 'verified'])->group(function () {
//     // Tableau de bord utilisateur
//     Route::get('/utilisateurs/dashboard', function () {
//         $user = Auth::user();
//         return view('dashboard', compact('user'));
//     })->name('dashboard');

//     // Vérifier si l'utilisateur est 'admin@gmail.com' pour les routes admin
//     Route::get('/admin/dashboard', function () {
//         $user = Auth::user(); // Récupère l'utilisateur authentifié

//         if ($user->email !== 'admin@gmail.com') {
//             // Si l'utilisateur n'est pas 'admin@gmail.com', rediriger ou montrer une erreur
//             return redirect()->route('/')->with('error', 'Accès non autorisé.');
//         }

//         return view('admin.dashboard', compact('user')); // Affiche le tableau de bord pour l'admin
//     })->name('admin.dashboard');

//     // Routes pour l'admin
//     Route::get('/admin/utilisateurs', [AdminUserController::class, 'index'])->name('admin.utilisateurs');
//     Route::delete('/admin/utilisateurs/{id}', [AdminUserController::class, 'destroy'])->name('admin.utilisateurs.destroy');
// });


Route::get('/utilisateurs/dashboard', function () {
    $user = Auth::user();
     return view('welcome', compact('user'));
     })->middleware(['auth', 'verified'])->name('dashboard');


// المسارات المحمية
/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::put('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
});
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::get('/pedagogie', [RessourceController::class, 'pedagogie'])->name('pedagogie');
Route::get('/neuralbox1', [RessourceController::class, 'neuralbox'])->name('neuralbox');





Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/welcome', [MessagesController::class, 'showRegistrationForm'])->name('welcome');
Route::post('/welcome', [MessagesController::class, 'register']); // صلحنا الاسم هنا

// routes/web.php






require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CoursController;
use App\Http\Controllers\MeanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PolicyControllers;
use App\Http\Controllers\conditionsControllers;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\subscribeControllers;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\MessagesController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\RendezVousController;
use App\Http\Controllers\admin\PaiementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminRendezVousController;
use App\Http\Controllers\Admin\DashboardExportController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\admin\RessourceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RateController;
use App\Livewire\VideoPlayer ;
use Illuminate\Http\Request;

// routes/web.php

// Route::middleware(['auth'])->group(function () {
//  Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');

//      Route::post('/contact/send-to-admin', [ContactController::class, 'sendToAdmin'])->name('contact.sendToAdmin');

//      Route::get('/contact/conversation/{user}', [ContactController::class, 'showConversation'])->name('contact.showConversation');

//      Route::post('/contact/message/{user}', [ContactController::class, 'sendMessageToUser'])->name('contact.sendMessageToUser');

//   Route::get('/messagerie', [ContactController::class, 'index'])->name('messagerie.index');
//   Route::post('/messagerie/send-admin', [ContactController::class, 'sendToAdmin'])->name('messagerie.sendToAdmin');
//   Route::post('/messagerie/send-user', [ContactController::class, 'sendMessageToUser'])->name('messagerie.sendMessageToUser');
//   // Pour charger les messages d'un utilisateur
//   Route::get('/messagerie/messages/{user}', [ContactController::class, 'getUserMessages']);

//   Route::middleware('auth')->get('/messagerie/messages/{user}', [ContactController::class, 'getUserMessages']);

//   // Pour envoyer un message (déjà existante, mais vérifiez qu'elle retourne du JSON)

//   // Dans votre contrôleur ContactController
//   Route::get('/messagerie/all-messages', [ContactController::class, 'getAllMessages'])->name('messagerie.getAllMessages');
//   Route::post('/messagerie/send-general', [ContactController::class, 'sendGeneralMessage'])->name('messagerie.sendGeneralMessage');
//   Route::get('/messages/{user}', [ContactController::class, 'getMessages'])->name('messagerie.getMessages');
//   Route::get('/messagerie/{user}', [ContactController::class, 'showConversation'])->name('messagerie.showConversation');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
//     Route::post('/contact/send-to-user', [ContactController::class, 'sendToUser'])->name('contact.sendToUser');
//     Route::post('/contact/send-to-admin', [ContactController::class, 'sendToAdmin'])->name('contact.sendToAdmin');
//     Route::get('/contact/conversation/{id}', [ContactController::class, 'showConversation'])->name('contact.showConversation');



// Routes pour la messagerie


Route::get('back', function () {
    return redirect()->back();
})->name('back');

Route::middleware('auth')->group(function () {
    // Page principale de messagerie
    Route::get('/messagerie', [ContactController::class, 'index'])->name('messagerie.index');

    // Envoyer un message à l'admin (utilisateurs normaux)
    Route::post('/messagerie/send-admin', [ContactController::class, 'sendToAdmin'])->name('messagerie.sendToAdmin');

    // Envoyer un message à un utilisateur spécifique (admins)
    Route::post('/messagerie/send-user', [ContactController::class, 'sendMessageToUser'])->name('messagerie.sendMessageToUser');

    // Charger les messages d'une conversation avec un utilisateur spécifique
    Route::get('/messagerie/messages/{user}', [ContactController::class, 'getUserMessages']);
    
    // Charger tous les messages généraux (pour les admins)
    Route::get('/messagerie/all-messages', [ContactController::class, 'getAllMessages'])->name('messagerie.getAllMessages');
    
    // Envoyer un message général (pour les admins)
    Route::post('/messagerie/send-general', [ContactController::class, 'sendGeneralMessage'])->name('messagerie.sendGeneralMessage');
    
    // Afficher une conversation spécifique (page dédiée)
    Route::get('/messagerie/conversation/{user}', [ContactController::class, 'showConversation'])->name('messagerie.showConversation');
    Route::get('/messagerie/messages-generaux', [ContactController::class, 'getGeneralMessages']);

    Route::get('/ressource/{id}/reviews', [RessourceController::class, 'reviews'])->name('ressource.reviews');
    Route::get('/reviewShow{id}', [RessourceController::class, 'reviewShow'])->name('ressource.reviews.show');
});



// Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show'])->name('subscriptions.show');
Route::get('/subscription/payment/{plan}', [SubscriptionController::class, 'showPaymentForm'])->name('subscription.payment');
Route::post('/subscription/process', [SubscriptionController::class, 'processSubscriptionPayment'])->name('subscription.process');
Route::get('/subscription/confirmation/{id}', [SubscriptionController::class, 'showConfirmation'])->name('subscription.confirmation');
Route::get('/subscription/success', [SubscriptionController::class, 'showSuccess'])->name('subscription.success');

// Routes existantes pour les paiements (à garder si nécessaire)
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/confirmation/{id}', [PaymentController::class, 'showConfirmation'])->name('payment.confirmation');


Route::post('/alreadyRated', [RateController::class, 'alreadyRated'])->name('rates.isAlreadySubmitted');

Route::resource('/rates', RateController::class);
Route::middleware(['auth', 'IsAdmin'])->group(function () {

    Route::get('/admin/ressources', [RessourceController::class, 'index'])->name('admin.ressources.index');
    Route::get('/admin/ressources/create', [RessourceController::class, 'create'])->name('admin.ressources.create');
    Route::post('/admin/ressources', [RessourceController::class, 'store'])->name('admin.ressources.store');
    Route::get('/admin/ressources/{ressource}/edit', [RessourceController::class, 'edit'])->name('admin.ressources.edit');
    Route::put('/admin/ressources/{ressource}', [RessourceController::class, 'update'])->name('admin.ressources.update');
    Route::delete('/admin/ressources/{ressource}', [RessourceController::class, 'destroy'])->name('admin.ressources.destroy');


    Route::resource('/admin/categories', CategoryController::class);

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
    Route::get('/admin/paiements/{id}', [PaiementController::class, 'show'])->name('admin.paiements.show');

    //admin subscription
    Route::get('/admin/subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscriptions');
    Route::get('/admin/subscriptions/{subscription}', [SubscriptionController::class, 'edit'])->name('admin.subscription_edit');
    Route::patch('/admin/subscriptions/{subscription}', [SubscriptionController::class, 'update'])->name('admin.subscription_update');


    // Mettre à jour le statut d'un rendez-vous (accepter/refuser)
    Route::patch('/admin/rendezvous/{id}/update-status', [AdminRendezVousController::class, 'updateStatus'])
        ->name('admin.rendezvous.updateStatus');

    // Récupérer les détails d'un rendez-vous (pour la modal)
    Route::get('/admin/rendezvous/{id}/details', [AdminRendezVousController::class, 'getDetails'])
        ->name('admin.rendezvous.details');
    Route::delete('/admin/rendezvous/{id}', [AdminRendezVousController::class, 'destroy'])->name('admin.rendezvous.destroy');
    Route::get('/admin/rendezvous/{id}/edit-statut', [AdminRendezVousController::class, 'editStatutArrive'])->name('admin.rendezvous.updateStatut');
    Route::patch('/admin/rendezvous/{id}/update-statut', [AdminRendezVousController::class, 'updateStatutArrive'])->name('admin.rendezvous.saveStatut');


    Route::get('admin/messages', [MessageController::class, 'index'])->name('admin.messages.index');
    Route::get('admin/messages/{id}', [MessageController::class, 'show'])->name('admin.messages.show');
    Route::post('admin/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('admin.messages.markAsRead');
    Route::delete('admin/messages/{id}', [MessageController::class, 'destroy'])->name('admin.messages.destroy');
    Route::get('/admin/export-pdf', [ExportController::class, 'exportPDF'])->name('admin.export.pdf');
    Route::get('/admin/export/paiements', [ExportController::class, 'exportPaiementsPDF'])->name('admin.export.paiements.pdf');
    Route::get('/admin/export/dashboard', [DashboardExportController::class, 'exportPdf'])->name('admin.export.dashboard.pdf');


    // Action d'export en PDF (GET, avec paramètres de filtre, format, sections)

});


Route::get('/prendre-rendez-vous', [RendezVousController::class, 'create'])->name('rendezvous.create');
Route::post('/prendre-rendez-vous', [RendezVousController::class, 'store'])->name('rendezvous.store');
Route::middleware(['auth'])->group(function () {
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
Route::get('conditions-utilisateur', [conditionsControllers::class, 'index'])->name('conditions-utilisateur');
Route::get('subscribe', [subscribeControllers::class, 'index'])->name('subscribe');

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
// Route::get('/video-url/{filename}', [CoursController::class, 'getVideoUrl'])->where('filename', '.*')->name('video-link');

Route::get('/secure/video/{path}', [CoursController::class, 'serveSecureVideo'])
    ->where('path', '.*')
    ->name('secure.video');
    // routes/web.php

Route::get('/video-url/{videoName}', [CoursController::class, 'getVideo'])
    ->where('videoName', '.*')
    ->name('video-link');

// Route::get('/video/{video}', [CoursController::class, 'getVideo'])
//     ->name('video.show')
//     ->middleware('signed'); // Ensures signature validity
// Route::get('/neuralbox', [NeuralBoxController::class, 'index'])->name('neuralbox');
// Route::get('/peda', [NeuralBoxController::class, 'peda'])->name('peda');
Route::get('/suivre', [MeanController::class, 'suivre'])->name('suivre');
// Route::get('/policy', [MeanController::class, 'suivre'])->name('suivre');
Route::get('/about', [AboutusController::class, 'about'])->name('about');
Route::get('/about2', [AboutusController::class, 'about2'])->name('about2');

// المسار للفيديو
Route::get('/video/stream/{filename}', function ($filename) {
    // تحقق من التوقيع

    if (!request()->hasValidSignature()) {
        abort(403, 'Unauthorized or expired link.');
    }

    $disk = Storage::disk('private');
    $filePath = $disk->path($filename);
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
        $bufferSize = 8192;
        $bytesSent = 0;
        while ($bytesSent < $length && !feof($handle)) {
            $readLength = min($bufferSize, $length - $bytesSent);
            $buffer = fread($handle, $readLength);
            echo $buffer;
            flush();
            $bytesSent += strlen($buffer);
        }
        fclose($handle);
    }, $statusCode, $headers);
})->where('filename', '.*')->name('video.stream');

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
Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->middleware('auth');

Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
Route::get('/peda', [RessourceController::class, 'pedagogie'])->name('peda');
Route::get('/neuralbox', [RessourceController::class, 'neuralbox'])->name('neuralbox');






Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');



Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');


Route::middleware(['web'])->group(function () {
    Route::put('/password', [NewPasswordController::class, 'store'])->name('password.update');
});


Route::put('/reset-password', [NewPasswordController::class, 'update'])->name('password.update');


Route::get('/welcome', [MessagesController::class, 'showRegistrationForm'])->name('welcome');
Route::post('/welcome', [MessagesController::class, 'register']); // صلحنا الاسم هنا

Route::get('/file/{type}/{id}', function ($type,$id) {

    if ($type == 'ressource')
        $model = \App\Models\Ressource::findOrFail($id);
    elseif ($type == 'paiement')
        $model = \App\Models\Paiement::findOrFail($id);
    $filePath = $model->preview_image ?? abort(404);
    // optional: validate filename to avoid path traversal
    $disk = Storage::disk('private'); // configure disk in config/filesystems.php
    if (! $disk->exists($filePath)) {
        abort(404);
    }

    // Optional: authorization logic
    // if (! $request->user()->can('view-image', $someModelOrId)) { abort(403); }

    // get mime type
    $mime = $disk->mimeType($filePath) ?? 'image/jpeg';

    // stream file to response (memory-efficient)
    return response()->stream(function () use ($disk, $filePath) {
        echo $disk->get($filePath);
    }, 200, [
        'Content-Type' => $mime,
        'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
        'Cache-Control' => 'public, max-age=604800, immutable',
    ]);
})->name('secure.file');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::post('/ressources/navigate', [RessourceController::class, 'navigate'])->name('ressource.navigate');

Route::post('/admin/ressources/upload-chunk', [RessourceController::class, 'uploadChunk'])->name('admin.ressources.uploadChunk');
Route::post('/admin/ressources/merge-chunks', [RessourceController::class, 'mergeChunks'])->name('admin.ressources.mergeChunks');

Route::get('/learning/{slug?}', VideoPlayer::class)->name('learning.index')->middleware('auth');

require __DIR__ . '/auth.php';

Route::patch('/admin/paiements/{paiement}/update-status', [PaiementController::class, 'updateStatus'])
    ->name('admin.paiements.update_status');



use App\Http\Controllers\admin\UtilisateurController;

Route::post('/utilisateurs/{id}/access', [UtilisateurController::class, 'giveAccess']);
Route::post('/utilisateurs/{id}/revoke', [UtilisateurController::class, 'revokeAccess']);
//Route::get('/video/{videoName}', [CoursController::class, 'getVideos'])->name('video-link');



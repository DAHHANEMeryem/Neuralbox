<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* Variables CSS */
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --primary-dark: #3a56d4;
            --secondary-color: #2b2d42;
            --accent-color: #ef476f;
            --success-color: #06d6a0;
            --warning-color: #ffd166;
            --text-color: #2b2d42;
            --text-light: #8d99ae;
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --border-radius: 12px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', 'Roboto', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
        }

        /* Layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: var(--card-bg);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
            padding: 0 20px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .logout-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .logout-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        /* Main content */
        main {
            padding: 40px 0;
        }

        .profile-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar */
        .profile-sidebar {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 30px;
            height: max-content;
            position: relative;
        }

        .profile-photo-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }

        .profile-photo {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-light);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .photo-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            opacity: 0;
            transition: var(--transition);
            cursor: pointer;
        }

        .profile-photo-container:hover .photo-overlay {
            opacity: 1;
        }

        .profile-photo-container:hover .profile-photo {
            filter: blur(1px);
        }

        .photo-upload-input {
            display: none;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        .profile-since {
            color: var(--text-light);
            text-align: center;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .profile-info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: var(--primary-light);
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .profile-info-icon {
            font-size: 1.2rem;
            color: var(--primary-color);
            margin-right: 15px;
            width: 24px;
            text-align: center;
        }

        .profile-info-content p:first-child {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 2px;
        }

        .profile-info-content p:last-child {
            font-weight: 600;
        }

        /* Main card */
        .profile-content {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 1px solid #e5e7eb;
        }

        .tab-button {
            padding: 16px 24px;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            background: none;
            border: none;
            font-size: 1rem;
        }

        .tab-button:focus {
            outline: none;
        }

        .tab-button.active {
            color: var(--primary-color);
        }

        .tab-button::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .tab-button.active::after {
            transform: scaleX(1);
        }

        /* Tab content */
        .tab-content {
            padding: 30px;
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media (max-width: 576px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        /* Phone input */
        .phone-input-container {
            display: flex;
        }

        .country-code {
            display: flex;
            align-items: center;
            padding: 0 12px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }

        .flag-icon {
            display: inline-block;
            width: 24px;
            height: 16px;
            margin-right: 8px;
            background-color: #c1272d;
            position: relative;
            overflow: hidden;
        }

        .flag-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background-color: transparent;
            border-left: 2px solid #006233;
            border-top: 2px solid #006233;
            border-right: 2px solid #006233;
            border-bottom: 2px solid #006233;
            transform-origin: center;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        }

        .phone-input {
            flex: 1;
            border-radius: 0 8px 8px 0;
        }

        /* Buttons */
        .buttons-container {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.95rem;
        }

        .btn:focus {
            outline: none;
        }

        .btn-secondary {
            background-color: #e5e7eb;
            color: var(--text-color);
        }

        .btn-secondary:hover {
            background-color: #d1d5db;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-danger {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc3545;
        }

        /* Password strength meter */
        .password-strength {
            margin-top: 8px;
        }

        .password-strength-meter {
            height: 5px;
            background-color: #e5e7eb;
            border-radius: 5px;
            margin-top: 5px;
            display: flex;
            overflow: hidden;
        }

        .password-strength-meter span {
            height: 100%;
            width: 25%;
            transition: var(--transition);
        }

        .password-strength-text {
            font-size: 0.8rem;
            margin-top: 5px;
        }

        /* Danger zone */
        .danger-zone {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }

        .danger-zone-title {
            color: var(--accent-color);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .danger-zone-description {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateX(120%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast-success {
            background-color: var(--success-color);
        }

        .toast-error {
            background-color: var(--accent-color);
        }

        .toast-icon {
            font-size: 1.2rem;
        }

        /* Profile card animation */
        .profile-content, .profile-sidebar {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .profile-sidebar.show {
            opacity: 1;
            transform: translateY(0);
        }

        .profile-content.show {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.2s;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">MonProfil</div>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

<button class="logout-btn" onclick="handleLogout(event)">
    <i class="fas fa-sign-out-alt"></i> Déconnexion
</button>


            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="container">
            <div class="profile-container">
                <!-- Sidebar with photo -->
                <div class="profile-sidebar">
                    <div class="profile-photo-container">
                        <img src="/api/placeholder/150/150" alt="Photo de profil" class="profile-photo" id="profile-photo">
                        <div class="photo-overlay">
                            <i class="fas fa-camera"></i>
                            <span>Changer</span>
                        </div>
                        <input type="file" id="photo-upload" class="photo-upload-input" accept="image/*">
                    </div>
                    <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                   <!-- <p class="profile-since">Membre depuis Octobre 2023</p>-->

                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="profile-info-content">
                            <p>Email</p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="profile-info-content">
                            <p>Téléphone</p>
                            <p>{{ Auth::user()->numero }}</p>
                        </div>
                    </div>

                    <div class="profile-info-item">
                        <div class="profile-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="profile-info-content">
                            <p>Adresse</p>
                            <p>{{ $user->rue }}, {{ $user->code_postal }} {{ $user->ville }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main content with tabs -->
                <div class="profile-content">
                    <div class="tabs">
                        <button class="tab-button active" data-tab="personal-info">Informations personnelles</button>
                        <button class="tab-button" data-tab="security">Sécurité</button>
                    </div>

                    <!-- Personal Info Tab -->
                    <div id="personal-info" class="tab-content active">
                        <form id="personal-info-form" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')                     
                            <h3 class="form-section-title">Informations de base</h3>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="firstName" class="form-label">Prénom</label>
                                    <input type="text" name="name" id="firstName" class="form-control" value="{{ $user->name }}">
                                </div>
                                
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <div class="phone-input-container">
                                        <div class="country-code">
                                            <div class="flag-icon"></div>
                                            <span>+212</span>
                                        </div>
                                        <input type="tel" name="numero" id="phone" class="form-control phone-input" value="{{ $user->numero }}">
                                    </div>
                                </div>
                            </div>

                            <h3 class="form-section-title">Adresse</h3>
                            <div class="form-group">
                                <label for="address" class="form-label">Rue</label>
                                <input type="text" name="rue" id="address" class="form-control" value="{{ $user->rue }}">
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="city" class="form-label">Ville</label>
                                    <input type="text" name="ville" id="city" class="form-control" value="{{ $user->ville }}">
                                </div>
                                <div class="form-group">
                                    <label for="postalCode" class="form-label">Code postal</label>
                                    <input type="text" name="code_postal" id="postalCode" class="form-control" value="{{ $user->code_postal }}">
                                </div>
                            </div>

                            <div class="buttons-container">
                                <button type="button" class="btn btn-secondary" id="reset-personal-info">Annuler</button>
                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Tab -->
                    <!-- Sécurité Tab -->
<div id="security" class="tab-content">
    <form action="{{ route('update.password') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="current_password">Mot de passe actuel</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="new_password">Nouveau mot de passe</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>
    
        <div class="form-group">
            <label for="new_password_confirmation">Confirmer le nouveau mot de passe</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>
    
        <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
    </form>
    
</div>

                </div>
            </div>
        </div>
    </main>

    <!-- Toast notifications -->
    <div class="toast toast-success" id="success-toast">
        <i class="fas fa-check-circle toast-icon"></i>
        <span>Les modifications ont été enregistrées avec succès!</span>
    </div>

    <div class="toast toast-error" id="error-toast">
        <i class="fas fa-exclamation-circle toast-icon"></i>
        <span>Une erreur s'est produite. Veuillez réessayer.</span>
    </div>

    <!-- ... (tout ce que tu as déjà mis jusqu'ici) -->

<script>
    // DOM Elements
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    const photoUploadInput = document.getElementById('photo-upload');
    const profilePhoto = document.getElementById('profile-photo');
    const photoOverlay = document.querySelector('.photo-overlay');
    const newPasswordInput = document.getElementById('newPassword');
    const passwordStrengthMeter = document.querySelector('.password-strength-meter');
    const passwordStrengthValue = document.getElementById('password-strength-value');
    const personalInfoForm = document.getElementById('personal-info-form');
    const securityForm = document.getElementById('security-form');
    const resetPersonalInfoBtn = document.getElementById('reset-personal-info');
    const deleteAccountBtn = document.getElementById('delete-account');
    const successToast = document.getElementById('success-toast');
    const errorToast = document.getElementById('error-toast');
    const profileSidebar = document.querySelector('.profile-sidebar');
    const profileContent = document.querySelector('.profile-content');

    const firstName = document.getElementById('firstName');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const address = document.getElementById('address');
    const city = document.getElementById('city');
    const postalCode = document.getElementById('postalCode');

    // Sauvegarder les valeurs initiales
    const initialValues = {
        name: firstName.value,
        email: email.value,
        phone: phone.value,
        address: address.value,
        city: city.value,
        postalCode: postalCode.value
    };

    // Animations
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            profileSidebar.classList.add('show');
            profileContent.classList.add('show');
        }, 100);
    });

    // Tabs
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            button.classList.add('active');
            const tabId = button.dataset.tab;
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Photo upload
    photoOverlay.addEventListener('click', () => {
        photoUploadInput.click();
    });

    photoUploadInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = (event) => {
                profilePhoto.src = event.target.result;
                showToast(successToast, 'Photo de profil mise à jour!');
            };
            reader.readAsDataURL(file);
        }
    });

    // Password strength meter
    newPasswordInput.addEventListener('input', (e) => {
        const password = e.target.value;
        const strength = calculatePasswordStrength(password);
        const strengthSegments = passwordStrengthMeter.querySelectorAll('span');
        strengthSegments.forEach((segment, index) => {
            segment.style.backgroundColor = index < strength ? getColorForStrength(strength) : '#e5e7eb';
        });
        passwordStrengthValue.textContent = getStrengthText(strength);
        passwordStrengthValue.style.color = getColorForStrength(strength);
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength += 1;
        if (/\d/.test(password)) strength += 1;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;
        if (/[^A-Za-z0-9]/.test(password)) strength += 1;
        return strength;
    }

    function getColorForStrength(strength) {
        return ['#e5e7eb', '#ef476f', '#ffd166', '#06d6a0', '#118ab2'][strength];
    }

    function getStrengthText(strength) {
        return ['Faible', 'Faible', 'Moyen', 'Bon', 'Fort'][strength];
    }

    // Formulaire "Infos personnelles"
    

    // Réinitialisation formulaire
    resetPersonalInfoBtn.addEventListener('click', () => {
        firstName.value = initialValues.name;
        email.value = initialValues.email;
        phone.value = initialValues.phone;
        address.value = initialValues.address;
        city.value = initialValues.city;
        postalCode.value = initialValues.postalCode;
        showToast(successToast, 'Changements annulés.');
    });

    // Sécurité : changement mot de passe
    securityForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (newPassword !== confirmPassword) {
            showToast(errorToast, 'Les mots de passe ne correspondent pas.');
            return;
        }

        if (calculatePasswordStrength(newPassword) < 3) {
            showToast(errorToast, 'Votre mot de passe est trop faible.');
            return;
        }

        // Simulation de succès
        showToast(successToast, 'Mot de passe mis à jour avec succès!');
        securityForm.reset();
    });

    // Suppression de compte (simulation)
    deleteAccountBtn.addEventListener('click', () => {
        const confirmation = confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');
        if (confirmation) {
            showToast(successToast, 'Compte supprimé (simulation)');
            // Rediriger vers une page ou déclencher une requête ici
        }
    });

    // Fonction de toast
    function showToast(toastElement, message) {
        toastElement.querySelector('span').textContent = message;
        toastElement.classList.add('show');
        setTimeout(() => {
            toastElement.classList.remove('show');
        }, 3000);
    }
     function handleLogout(event) {
        event.preventDefault(); // Empêche le rechargement ou navigation immédiate

        if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?")) {
            document.getElementById('logout-form').submit();
        }
    }
</script>

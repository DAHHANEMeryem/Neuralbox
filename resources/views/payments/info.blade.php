<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Paiement | Neural Box</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #4361ee;
            --primary-light: #e8edff;
            --dark: #18191a;
            --dark-light: #444;
            --light: #f5f7fa;
            --success: #36b37e;
            --warning: #ffab00;
            --danger: #ff5630;
            --gray: #8d99ae;
            --border-radius: 12px;
            --shadow: 0 8px 30px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f6f9fc 0%, #e9f0f9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: var(--dark);
        }
        
        .payment-container {
            width: 100%;
            max-width: 800px;
            background: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        
        .payment-header {
            background: var(--primary);
            color: white;
            padding: 1.5rem 2rem;
            position: relative;
        }
        
        .payment-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 20px;
            background: white;
            border-radius: 50% 50% 0 0;
        }
        
        .payment-header h2 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 600;
        }
        
        .payment-header p {
            margin: 0.5rem 0 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .payment-body {
            padding: 2rem;
        }
        
        .section {
            margin-bottom: 2rem;
        }
        
        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 1.2rem;
            color: var(--dark);
        }
        
        .section-title i {
            margin-right: 0.8rem;
            background: var(--primary-light);
            color: var(--primary);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        
        .section-title h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--dark-light);
        }
        
        select, 
        input[type="text"], 
        input[type="number"],
        input[type="month"] {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e1e5ee;
            border-radius: 8px;
            background-color: #fff;
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
            color: var(--dark);
        }
        
        select:focus, 
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .form-group {
            margin-bottom: 1.2rem;
        }
        
        .form-row {
            display: flex;
            gap: 1rem;
        }
        
        .form-row > div {
            flex: 1;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .payment-option {
            position: relative;
            border: 2px solid #e1e5ee;
            border-radius: 10px;
            padding: 1.2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            overflow: hidden;
        }
        
        .payment-option:hover {
            transform: translateY(-2px);
        }
        
        .payment-option.active {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }
        
        .payment-option.active::before {
            content: '\f00c';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 5px;
            right: 5px;
            background: var(--primary);
            color: white;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .payment-option i {
            font-size: 1.8rem;
            color: var(--dark-light);
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }
        
        .payment-option.active i {
            color: var(--primary);
        }
        
        .payment-option span {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .payment-details {
            display: none;
            margin-top: 1.5rem;
            padding: 1.2rem;
            border-radius: 10px;
            background-color: #f8fafd;
            border: 1px dashed #cfd8dc;
            animation: fadeIn 0.4s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: var(--gray);
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .security-code {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .security-code img {
            width: 40px;
            height: 40px;
            opacity: 0.5;
        }
        
        .security-code span {
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        .bank-info {
            background: linear-gradient(to right, var(--primary-light), #f8fafd);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid var(--primary);
        }
        
        .bank-info h4 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        
        .bank-info p {
            margin: 0.7rem 0;
            display: flex;
            justify-content: space-between;
            font-size: 0.95rem;
        }
        
        .bank-info p span:last-child {
            font-weight: 500;
        }
        
        .amount-display {
            text-align: right;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .amount-display small {
            font-size: 1rem;
            font-weight: normal;
            color: var(--gray);
        }
        
        .btn {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.15);
        }
        
        .btn:hover {
            background: #3652d9;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.2);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            flex: 1;
        }
        
        .step::before, .step::after {
            content: '';
            position: absolute;
            height: 2px;
            background-color: #e1e5ee;
            top: 15px;
            width: 50%;
            z-index: -1;
        }
        
        .step::before {
            left: 0;
        }
        
        .step::after {
            right: 0;
        }
        
        .step:first-child::before {
            display: none;
        }
        
        .step:last-child::after {
            display: none;
        }
        
        .step.active::before, .step.active::after {
            background-color: var(--primary);
        }
        
        .step.active ~ .step::before, .step.active ~ .step::after {
            background-color: #e1e5ee;
        }
        
        .step-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e1e5ee;
            color: var(--dark-light);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }
        
        .step.active .step-icon {
            background-color: var(--primary);
            color: white;
        }
        
        .step-label {
            font-size: 0.8rem;
            color: var(--dark-light);
        }
        
        .step.active .step-label {
            color: var(--primary);
            font-weight: 500;
        }
        
        .paypal-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #fafaff;
            padding: 1rem;
            border-radius: 10px;
            border: 1px solid #e1e5f5;
        }
        
        .paypal-info i {
            font-size: 2rem;
            color: #0070ba;
        }
        
        .paypal-info p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--dark-light);
        }
        
        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 1.5rem 0;
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        .secure-badge i {
            color: var(--success);
        }
        
        .payment-footer {
            border-top: 1px solid #edf2f7;
            padding: 1.5rem 2rem;
            text-align: center;
            font-size: 0.8rem;
            color: var(--gray);
        }
        
        /* Animation classes */
        .animate__animated {
            --animate-duration: 0.5s;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .payment-body {
                padding: 1.5rem;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .step-indicator {
                overflow-x: auto;
                padding-bottom: 1rem;
            }
            
            .step {
                min-width: 80px;
            }
        }
    </style>
</head>
<body>

<div class="payment-container animate__animated animate__fadeIn">
    <div class="payment-header">
        <h2>Paiement Sécurisé</h2>
        <p>Complétez votre inscription à Neural Box</p>
    </div>
    
    <div class="payment-body">
        <!-- Indicateur d'étape -->
        <div class="step-indicator">
            <div class="step active">
                <div class="step-icon">1</div>
                <div class="step-label">Type</div>
            </div>
            <div class="step">
                <div class="step-icon">2</div>
                <div class="step-label">Paiement</div>
            </div>
            <div class="step">
                <div class="step-icon">3</div>
                <div class="step-label">Confirmation</div>
            </div>
        </div>
        
        <!-- Type de Bac -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-graduation-cap"></i>
                <h3>Type de Baccalauréat</h3>
            </div>
            
            <div class="form-group">
                <label for="bac-type">Sélectionnez votre type de baccalauréat :</label>
                <select id="bac-type" class="animate__animated animate__fadeIn">
                    <option value="" disabled selected>-- Choisissez --</option>
                    <option value="3200">Baccalauréat Marocain - 3200 MAD</option>
                    <option value="2300">Baccalauréat Étranger - 2300 MAD</option>
                </select>
            </div>
            
            <div class="amount-display" id="amount-display">
                <small>Montant total</small><br>
                <span>-- MAD</span>
            </div>
        </div>
        
        <!-- Méthodes de paiement -->
        <div class="section">
            <div class="section-title">
                <i class="fas fa-wallet"></i>
                <h3>Méthode de paiement</h3>
            </div>
            
            <div class="payment-methods animate__animated animate__fadeIn">
                <div class="payment-option" data-method="carte">
                    <i class="fas fa-credit-card"></i>
                    <span>Carte Bancaire</span>
                </div>
                <div class="payment-option" data-method="paypal">
                    <i class="fab fa-paypal"></i>
                    <span>PayPal</span>
                </div>
                <div class="payment-option" data-method="virement">
                    <i class="fas fa-university"></i>
                    <span>Virement Bancaire</span>
                </div>
            </div>
            
            <!-- Détails selon la méthode -->
            <div id="carte-details" class="payment-details">
                <div class="form-group">
                    <label for="card-number">Numéro de carte</label>
                    <div class="input-wrapper">
                        <input type="text" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
                        <div class="card-icon">
                            <i class="fab fa-cc-visa"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="card-name">Nom sur la carte</label>
                    <input type="text" id="card-name" placeholder="Prénom NOM">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="card-expiry">Date d'expiration</label>
                        <input type="month" id="card-expiry">
                    </div>
                    <div class="form-group security-code">
                        <div>
                            <label for="card-cvv">Code de sécurité</label>
                            <input type="text" id="card-cvv" placeholder="123" maxlength="4">
                        </div>
                        <img src="/api/placeholder/30/20" alt="CVV example">
                    </div>
                </div>
                
                <div class="secure-badge">
                    <i class="fas fa-lock"></i> Paiement sécurisé avec cryptage SSL
                </div>
            </div>
            
            <div id="paypal-details" class="payment-details">
                <div class="paypal-info">
                    <i class="fab fa-paypal"></i>
                    <p>En cliquant sur "Procéder au paiement", vous serez redirigé vers PayPal pour finaliser votre transaction en toute sécurité.</p>
                </div>
            </div>
            
            <div id="virement-details" class="payment-details">
                <div class="bank-info">
                    <h4>Informations Bancaires</h4>
                    <p><span>Banque :</span> <span>Banque Populaire</span></p>
                    <p><span>Bénéficiaire :</span> <span>NEURAL BOX</span></p>
                    <p><span>Numéro RIB :</span> <span>123 456 789 1011 1213 1415</span></p>
                    <p><span>IBAN :</span> <span>MA123456789101112131415</span></p>
                    <p><span>BIC/SWIFT :</span> <span>BCPOMAMC</span></p>
                    <p><span>Montant à transférer :</span> <span id="bank-amount">-- MAD</span></p>
                </div>
                
                <div class="form-group" style="margin-top: 1rem;">
                    <p style="font-size: 0.9rem; color: var(--gray); margin-bottom: 0.5rem;">Veuillez inclure votre nom et prénom dans la référence du virement.</p>
                </div>
            </div>
        </div>
        
        <button class="btn animate__animated animate__pulse" id="payment-button" onclick="submitPayment()">
            <i class="fas fa-lock"></i> Procéder au paiement
        </button>
    </div>
    
    <div class="payment-footer">
        © 2025 Neural Box - Tous droits réservés
    </div>
</div>

<script>
    
    // Formater automatiquement le numéro de carte avec des espaces
    document.getElementById('card-number')?.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s+/g, '');
        if (value.length > 0) {
            value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
        }
        e.target.value = value;
        
        // Détecter le type de carte et afficher l'icône correspondante
        const cardIcon = document.querySelector('.card-icon i');
        if (value.startsWith('4')) {
            cardIcon.className = 'fab fa-cc-visa';
        } else if (/^5[1-5]/.test(value)) {
            cardIcon.className = 'fab fa-cc-mastercard';
        } else if (/^3[47]/.test(value)) {
            cardIcon.className = 'fab fa-cc-amex';
        } else {
            cardIcon.className = 'fas fa-credit-card';
        }
    });
    
    // Formater automatiquement le CVV pour n'accepter que les chiffres
    document.getElementById('card-cvv')?.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^\d]/g, '');
    });
    
    // Gérer la sélection des méthodes de paiement
    const options = document.querySelectorAll('.payment-option');
    const details = {
        carte: document.getElementById('carte-details'),
        paypal: document.getElementById('paypal-details'),
        virement: document.getElementById('virement-details'),
    };
    
    let selectedMethod = null;
    
    options.forEach(option => {
        option.addEventListener('click', () => {
            options.forEach(o => o.classList.remove('active'));
            option.classList.add('active', 'animate__animated', 'animate__pulse');
            selectedMethod = option.dataset.method;
            
            // Mettre à jour le texte du bouton selon la méthode
            const payButton = document.getElementById('payment-button');
            if (selectedMethod === 'paypal') {
                payButton.innerHTML = '<i class="fab fa-paypal"></i> Continuer vers PayPal';
            } else if (selectedMethod === 'virement') {
                payButton.innerHTML = '<i class="fas fa-check-circle"></i> Confirmer le virement';
            } else {
                payButton.innerHTML = '<i class="fas fa-lock"></i> Procéder au paiement';
            }
            
            // Afficher les détails correspondants
            for (const key in details) {
                details[key].style.display = 'none';
            }
            
            details[selectedMethod].style.display = 'block';
            
            // Mettre à jour les étapes
            document.querySelectorAll('.step')[1].classList.add('active');
        });
    });
    
    // Mettre à jour les montants lorsque le type de bac change
    document.getElementById('bac-type').addEventListener('change', function() {
        const amount = this.value;
        document.getElementById('amount-display').querySelector('span').innerText = amount + ' MAD';
        document.getElementById('bank-amount').innerText = amount + ' MAD';
        
        // Animation pour l'affichage du montant
        document.getElementById('amount-display').classList.add('animate__animated', 'animate__pulse');
        setTimeout(() => {
            document.getElementById('amount-display').classList.remove('animate__animated', 'animate__pulse');
        }, 1000);
    });
    
    // Fonction de soumission du paiement
    function submitPayment() {
        const bacType = document.getElementById('bac-type').value;
        
        if (!bacType) {
            alert("Veuillez sélectionner le type de Baccalauréat.");
            document.getElementById('bac-type').focus();
            return;
        }
        
        if (!selectedMethod) {
            alert("Veuillez choisir une méthode de paiement.");
            return;
        }
        
        // Validation spécifique pour la carte
        if (selectedMethod === 'carte') {
            const cardNumber = document.getElementById('card-number').value;
            const cardName = document.getElementById('card-name').value;
            const cardExpiry = document.getElementById('card-expiry').value;
            const cardCvv = document.getElementById('card-cvv').value;
            
            if (!cardNumber || !cardName || !cardExpiry || !cardCvv) {
                alert("Veuillez remplir tous les champs de paiement par carte.");
                return;
            }
        }
        
        // Animation avant confirmation
        document.getElementById('payment-button').classList.add('animate__animated', 'animate__flash');
        
        // Simulation d'un chargement
        document.getElementById('payment-button').innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement en cours...';
        document.getElementById('payment-button').disabled = true;
        
        // On simule un délai pour l'effet
        setTimeout(() => {
            // Actualiser les étapes
            document.querySelectorAll('.step')[2].classList.add('active');
            
            // Message de confirmation selon la méthode
            let message = "";
            if (selectedMethod === 'carte') {
                message = "Paiement par carte accepté ! Un email de confirmation va vous être envoyé.";
            } else if (selectedMethod === 'paypal') {
                message = "Vous allez être redirigé vers PayPal pour finaliser votre paiement de " + bacType + " MAD.";
            } else {
                message = "Votre demande de paiement par virement de " + bacType + " MAD a été enregistrée. N'oubliez pas d'effectuer le virement dans les 48h.";
            }
            
            alert(message);
            
            // Réinitialisation du bouton
            document.getElementById('payment-button').innerHTML = '<i class="fas fa-check-circle"></i> Paiement effectué';
            document.getElementById('payment-button').style.backgroundColor = 'var(--success)';
        }, 1500);
    }
</script>

</body>
</html>
$(document).ready(function() {
    // Formatage du numéro de carte
    $('#card_number').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
        
        // Détection du type de carte
        let number = $(this).val();
        if (number.startsWith('4')) {
            $('.card-input i').attr('class', 'fab fa-cc-visa');
        } else if (number.startsWith('5')) {
            $('.card-input i').attr('class', 'fab fa-cc-mastercard');
        } else if (number.startsWith('3')) {
            $('.card-input i').attr('class', 'fab fa-cc-amex');
        } else {
            $('.card-input i').attr('class', 'fab fa-cc-visa');
        }
    });
    
    // Formatage de la date d'expiration (MM/YY)
    $('#expiration_date').on('input', function() {
        let val = $(this).val().replace(/\D/g, '');
        
        if (val.length > 0) {
            if (val.length <= 2) {
                // Mois uniquement
                $(this).val(val);
            } else {
                // Mois et année
                let month = val.substring(0, 2);
                let year = val.substring(2, 4);
                $(this).val(month + '/' + year);
            }
        }
    });
    
    // Formatage du CVV
    $('#cvv').on('input', function() {
        $(this).val($(this).val().replace(/\D/g, ''));
    });
    
    // Validation du montant
    $('#amount').on('input', function() {
        let val = parseFloat($(this).val());
        if (isNaN(val) || val <= 0) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    
    // Sélection de la méthode de paiement
    $('.payment-method-option').click(function() {
        $('.payment-method-option').removeClass('selected');
        $(this).addClass('selected');
        
        let method = $(this).data('method');
        $('#payment_method').val(method);
        
        // Afficher/masquer la section carte de crédit selon la méthode
        if (method === 'credit_card') {
            $('#credit-card-section').show();
            $('#payment-method-info').hide();
        } else {
            $('#credit-card-section').hide();
            $('#payment-method-info').show();
            
            if (method === 'paypal') {
                $('#paypal-info').show();
                $('#bank-info').hide();
            } else if (method === 'bank_transfer') {
                $('#paypal-info').hide();
                $('#bank-info').show();
            }
        }
    });
    
    // Validation du formulaire avant soumission
    $('#payment-form').on('submit', function(e) {
        let isValid = true;
        let method = $('#payment_method').val();
        
        if (method === 'credit_card') {
            // Vérification du numéro de carte
            if ($('#card_number').val().length !== 16) {
                $('#card_number').addClass('is-invalid');
                isValid = false;
            } else {
                $('#card_number').removeClass('is-invalid');
            }
            
            // Vérification de la date d'expiration
            let expDate = $('#expiration_date').val();
            if (!/^(0[1-9]|1[0-2])\/[0-9]{2}$/.test(expDate)) {
                $('#expiration_date').addClass('is-invalid');
                isValid = false;
            } else {
                let parts = expDate.split('/');
                let month = parseInt(parts[0]);
                let year = parseInt('20' + parts[1]);
                let today = new Date();
                let expiry = new Date(year, month);
                
                if (expiry < today) {
                    $('#expiration_date').addClass('is-invalid');
                    isValid = false;
                } else {
                    $('#expiration_date').removeClass('is-invalid');
                }
            }
            
            // Vérification du CVV
            if ($('#cvv').val().length !== 3) {
                $('#cvv').addClass('is-invalid');
                isValid = false;
            } else {
                $('#cvv').removeClass('is-invalid');
            }
        }
        
        if (!isValid) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('.is-invalid:first').offset().top - 100
            }, 200);
        } else {
            // Affichage d'un indicateur de chargement
            $(this).find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin me-2"></i>Traitement en cours...');
            $(this).find('button[type="submit"]').prop('disabled', true);
        }
    });
});
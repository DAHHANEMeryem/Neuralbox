@extends('layouts.app')

@section('title', 'Confirmation de Paiement')

@section('styles')
<style>
   .confirmation-card {
    max-width: 750px;
    margin: 40px auto;
    padding: 20px;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    background-color: #ffffff;
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
}

.confirmation-header {
    text-align: center;
    margin-bottom: 30px;
}

.confirmation-icon {
    font-size: 80px;
    color: #27ae60;
}

.confirmation-header h2 {
    font-weight: 700;
    color: #2c3e50;
}

.confirmation-details {
    background-color: #f9f9f9;
    border-radius: 12px;
    padding: 20px;
    margin-top: 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #e0e0e0;
}

.detail-label {
    color: #555;
    font-weight: 600;
}

.transaction-id {
    background-color: #ecf7ff;
    border: 1px dashed #3498db;
    padding: 16px;
    border-radius: 8px;
    font-family: monospace;
    text-align: center;
}

.amount-paid {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
}

.btn-outline-primary,
.btn-primary {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
}

</style>
@endsection

@section('content')
<div class="confirmation-card">
    <div class="card">
        <div class="card-body">
            <div class="confirmation-header">
                <div class="confirmation-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2>Paiement Confirmé</h2>
                <p class="lead">Merci pour votre paiement. Votre transaction a été complétée avec succès.</p>
            </div>
            
            <div class="transaction-id">
                <div class="small text-muted">ID DE TRANSACTION</div>
                <div class="fs-5">{{ strtoupper(substr(md5($paymentInfo->id), 0, 16)) }}</div>
            </div>
            
            <div class="text-center mb-4">
                <div class="text-muted">MONTANT PAYÉ</div>
                <div class="amount-paid">{{ number_format($paymentInfo->amount, 2, ',', ' ') }} €</div>
            </div>
            
            <div class="confirmation-details">
                <div class="detail-row">
                    <div class="detail-label">Date</div>
                    <div>{{ $paymentInfo->created_at->format('d/m/Y H:i') }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Méthode de paiement</div>
                    <div>
                        @if($paymentInfo->payment_method == 'credit_card')
                            <i class="fas fa-credit-card me-2"></i>Carte de crédit
                        @elseif($paymentInfo->payment_method == 'paypal')
                            <i class="fab fa-paypal me-2"></i>PayPal
                        @else
                            <i class="fas fa-university me-2"></i>Virement bancaire
                        @endif
                    </div>
                </div>
                
                @if($paymentInfo->payment_method == 'credit_card')
                    <div class="detail-row">
                        <div class="detail-label">Carte</div>
                        <div>{{ $paymentInfo->getMaskedCardNumberAttribute() }}</div>
                    </div>
                @endif
                
                <div class="detail-row">
                    <div class="detail-label">Nom</div>
                    <div>{{ $paymentInfo->card_holder_name }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Email</div>
                    <div>{{ $paymentInfo->email }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Statut</div>
                    <div>
                        <span class="badge bg-success">Complété</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('payment.form') }}" class="btn btn-outline-primary me-2">
                    <i class="fas fa-credit-card me-2"></i>Nouveau paiement
                </a>
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
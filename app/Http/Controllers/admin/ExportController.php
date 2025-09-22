<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
 // alias de Barryvdh

use App\Models\User; // ou ce que tu veux exporter
use App\Models\Paiement;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportPDF()
    {
        $users = User::all(); // ou tout autre contenu à exporter
        $pdf = Pdf::loadView('admin.exports.users', compact('users'));
        return $pdf->download('liste_utilisateurs.pdf');
    }
    
public function exportPaiementsPDF()
{
    $payments = Paiement::all(); // récupérer tous les paiements

    $pdf = PDF::loadView('admin.exports.paiements', compact('payments'));

    return $pdf->download('liste_paiements.pdf');
}
}

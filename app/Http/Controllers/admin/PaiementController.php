<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Subscription;
use Carbon\Carbon;

class PaiementController extends Controller
{
    public function index(Request $request)
    {
        $query = Paiement::query();


        // Récupère les paiements de 2300 MAD
        // $neuralboxs = Subscription::where('type', 'neuralbox')->with(['user' => function ($query) {
        //     $query->select('id', 'name'); // Select specific attributes from the 'users' table
        // }])->paginate(10);
        // $goldens = Subscription::where('type', 'golden')->with(['user' => function ($query) {
        //     $query->select('id', 'name'); // Select specific attributes from the 'users' table
        // }])->paginate(10);


        // Récupère les paiements de 3200 MAD
        // $paiements_3200 = Paiement::where('amount', 3200)->get();



        // فلترة حسب المستخدم
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user->name . '%');
            });
        }

        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فلترة بالتاريخ
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $paiements = $query->with('user')->latest()->paginate(10);

        // إحصائيات
        $total = Paiement::where('status', 'validated')->sum('amount');

        $successCount = Paiement::where('status', 'validated')->count();
        $failCount = Paiement::where('status', 'failed')->count();
        $pendingCount = Paiement::where('status', 'pending')->count();
        $monthlyRevenue = Paiement::where('status', 'validated')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');
           

        return view('admin.paiements.index', compact(
            'paiements',
            'total',
            'successCount',
            'failCount',
            'pendingCount',
            'monthlyRevenue',
        ));
    }



    public function show($id)
    {
        $payment = Paiement::with('user')->findOrFail($id); // Fetch the rendezvous by its ID
        return view('admin.paiements.show', compact('payment')); // Pass it to the view
    }
public function updateStatus(Request $request, Paiement $paiement)
{
    // Mettre à jour le status du paiement
    $paiement->status = $request->input('status', $paiement->status);
    $paiement->save();

    // Vérifier si le paiement est validé
    if ($paiement->status === 'validated') {

        // Vérifier si une subscription existe déjà pour ce paiement
        $subscription = $paiement->subscription;

        if (!$subscription) {
            // Déterminer le type de subscription selon le montant
            if ($paiement->amount == 2300) {
                $type = 'neuralbox';
            } elseif ($paiement->amount == 3200) {
                $type = 'golden';
            } else {
                $type = 'basic'; // fallback si montant inconnu
            }

            // Créer la subscription
            $subscription = $paiement->user->subscriptions()->create([
                'user_id' => $paiement->user_id,
                'paiement_id' => $paiement->id,
                'type' => $type,
                'status' => 'validated',
                'start_date' => now(),
                'end_date' => now()->addMonth(),
            ]);
        }

        // 🔹 Redirection vers la rubrique correspondante
        if ($subscription->type == 'neuralbox') {
            return redirect()->route('admin.subscriptions', ['filter' => 'neuralbox'])
                             ->with('success', 'Paiement validé et abonné Neuralbox créé.');
        } elseif ($subscription->type == 'golden') {
            return redirect()->route('admin.subscriptions', ['filter' => 'golden'])
                             ->with('success', 'Paiement validé et abonné Golden créé.');
        }
    }

    return redirect()->back()->with('success', 'Paiement mis à jour.');
}

public function subscriptions(Request $request)
{
    // Récupérer les abonnements Neuralbox et Golden
    $neuralboxs = Subscription::where('type', 'neuralbox')->with('user')->paginate(10, ['*'], 'neuralbox_page');
    $goldens = Subscription::where('type', 'golden')->with('user')->paginate(10, ['*'], 'golden_page');

    return view('admin.subscriptions.index', compact('neuralboxs', 'goldens'));
}



 

}

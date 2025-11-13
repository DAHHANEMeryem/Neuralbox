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
        $query = Subscription::query();
        

        // Récupère les paiements de 2300 MAD
        $neuralboxs = Subscription::where('type', 'neuralbox')->with(['user' => function ($query) {
            $query->select('id', 'name'); // Select specific attributes from the 'users' table
        }])->get();
        $goldens = Subscription::where('type', 'golden')->with(['user' => function ($query) {
            $query->select('id', 'name'); // Select specific attributes from the 'users' table
        }])->get();


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
       $total = Paiement::where('status', 'success')->sum('amount');

        $successCount = Paiement::where('status', 'success')->count();
        $failCount = Paiement::where('status', 'failed')->count();
        $monthlyRevenue = Paiement::where('status', 'success')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');
           

        return view('admin.paiements.index', compact(
            'paiements',
            'total',
            'successCount',
            'failCount',
            'monthlyRevenue',
            'neuralboxs',
            'goldens'
        ));
    }
}

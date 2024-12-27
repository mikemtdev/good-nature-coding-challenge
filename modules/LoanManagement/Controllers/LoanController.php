<?php
namespace Modules\LoanManagement\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Modules\LoanManagement\Models\Loan;

class LoanController extends Controller
{
    //

    public function index()
    {
        $loans = Loan::with('farmer')->paginate(10);
//        dd($loans->);
        return view('LoanManagement::index', compact('loans'));
    }

    public function create()
    {

        $farmers = Farmer::all();
        return view('LoanManagement::create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0',
            'repayment_duration' => 'required|integer|min:1',
        ]);

        Loan::create($request->only('farmer_id', 'amount', 'interest_rate', 'repayment_duration'));


        return redirect()->back()->with("success", "Loan add successfully ");
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Loan approved successfully.');
    }

    public function reject($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status'=> 'approved']);
        return redirect()->back()->with("success", "Loan rejected successfully");
    }

    public function markAsRepaid($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => "repaid"]);
        return redirect()->back()->with("success", "Loan Repaid successfully");
    }
}

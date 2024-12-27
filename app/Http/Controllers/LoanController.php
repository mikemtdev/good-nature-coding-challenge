<?php

namespace App\Http\Controllers;

use App\Models\loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    //

    public function index()
    {
        $loans = loan::with('farmer')->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function approve($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update(['status' => 'approved']);
        return redirect()->back()->with('success', 'Loan approved successfully.');
    }

    public function reject($id)
    {
        $loan = loan::findOrFail($id);
        $loan->update(['status'=> 'approved']);
        return redirect()->back()->with("success", "Loan rejected successfully");
    }

    public function markAsRepaid($id)
    {
        $loan = loan::findOrFail($id);
        $loan->update(['status' => "repaid"]);
        return redirect()->back()->with("success", "Loan Repaid successfully");
    }
}

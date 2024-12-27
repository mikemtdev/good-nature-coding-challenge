<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Loan;
use Illuminate\Http\Request;

class ReportController extends Controller
{


    public function index()
    {
        $totalFarmers = Farmer::count();
        $totalLoans = Loan::count();
        $totalAmount = Loan::where('status', 'approved')->sum('amount');
        $approvedLoans = Loan::where('status', 'approved')->count();
        $pendingLoans = Loan::where('status', 'pending')->count();
        $rejectedLoans = Loan::where('status', 'rejected')->count();

        return view('reports.index', compact( 'totalFarmers',
                'totalLoans',
            'totalAmount',
            'approvedLoans',
            'pendingLoans',
            'rejectedLoans'));
    }
}

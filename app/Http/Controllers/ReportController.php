<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Modules\LoanManagement\Models\Loan;
use App\Helpers\ModuleHelper;
class ReportController extends Controller
{


    public function index()
    {
        $totalFarmers = Farmer::count();

        if(ModuleHelper::isModuleLoaded("LoanManagement")) {
            $totalLoans = Loan::count();
            $totalAmount = Loan::where('status', 'approved')->sum('amount');
            $approvedLoans = Loan::where('status', 'approved')->count();
            $pendingLoans = Loan::where('status', 'pending')->count();
            $rejectedLoans = Loan::where('status', 'rejected')->count();
        }else{
            $totalLoans = null;
            $totalAmount = null;
            $approvedLoans = null;
            $pendingLoans = null;
            $rejectedLoans = null;

        }

        return view('reports.index', compact( 'totalFarmers',
                'totalLoans',
            'totalAmount',
            'approvedLoans',
            'pendingLoans',
            'rejectedLoans'));
    }
}

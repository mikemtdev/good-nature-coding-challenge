<?php

namespace Modules\LoanManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Farmer;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'amount',
        'interest_rate',
        'repayment_duration',
        'status',
    ];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
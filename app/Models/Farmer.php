<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\LoanManagement\Models\Loan;

class Farmer extends Model
{
    use HasFactory;
    //
    protected $fillable =[
        'name', 'phone', 'location'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}

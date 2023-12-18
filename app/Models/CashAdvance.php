<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function deductions()
    {
        return $this->hasMany(Deductions::class, 'cashAdvanceId');
    }

    public function total()
    {
        return $this->belongsTo(EmployeeCashAdvanceTotal::class, 'cash_id');
    }

    public function getFormattedRequestDateAttribute()
    {
        return Carbon::parse($this->attributes['requestDate'])->format('F j, Y');
    }
}

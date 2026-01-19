<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'category', 'amount', 'expense_date', 'user_id'];
    protected $casts = [
        'expense_date' => 'date',
    ];
}

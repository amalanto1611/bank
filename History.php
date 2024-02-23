<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    
    protected $fillable = [
        
       
    
        'email',
        'amount',
        'type',
        'details',
        'balance',
        'created_at',
        'updated_at'
    
    ];
    use HasFactory;
}

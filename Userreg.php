<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userreg extends Model
{
    protected $table = 'user';
    protected $primarykey='id';
    protected $fillable = [
        'id',
       
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    
    ];
    use HasFactory;
}

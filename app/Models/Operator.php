<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomOperator',
        'user_id',
    ];

     // belongsto with user
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }

     public function transactions()
     {
         return $this->belongsToMany(Transaction::class);
     }
}

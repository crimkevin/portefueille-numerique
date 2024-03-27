<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Transaction extends Model
{
    use HasFactory;

    use Notifiable;
    protected $fillable = [
        'amountTransaction',
        'statue',
        'dateTransaction',
        'senderName',
        'receiverName',
        'refTransaction',
        'PaymentMethod',
        'user_id',

    ];

    // belongsto with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     /**
     * The users that belong to the operator.
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class);
    }
}

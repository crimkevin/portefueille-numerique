<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
        'intituller',

    ];
    // belongsto with user
    public function user(): BelongsTo
    {
        // Get the typeUser associated with the user.
        return $this->belongsTo(User::class, 'TypeUser_id');
    }
}

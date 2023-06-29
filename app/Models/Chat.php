<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_user_id',
        'second_user_id',
    ];

    public function messages() :HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function first_user():BelongsTo
    {
        return $this->belongsTo(User::class, 'first_user_id');
    }

    public function second_user():BelongsTo
    {
        return $this->belongsTo(User::class, 'second_user_id');
    }

}

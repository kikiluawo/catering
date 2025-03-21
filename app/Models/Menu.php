<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'image',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

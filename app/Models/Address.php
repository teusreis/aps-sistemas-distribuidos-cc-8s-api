<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'numero',
        'rua',
        'bairro',
        'cidade',
        'complemento',
        'ponto_referencia',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

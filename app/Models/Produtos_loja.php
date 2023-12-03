<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos_loja extends Model
{
    use HasFactory;

    protected $fillable = [
        'referencia_produto',
        'nome_produto',
        'preco_produto',
        'tipo_produto',
        'foto1_produto',
        'foto2_produto',
    ];
}

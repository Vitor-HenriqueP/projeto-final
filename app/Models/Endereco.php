<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'contato_id', 'cep', 'endereco', 'numero_residencia', 'bairro', 'cidade', 'uf'
    ];

    public function contato()
    {
        return $this->belongsTo(Contato::class);
    }
}


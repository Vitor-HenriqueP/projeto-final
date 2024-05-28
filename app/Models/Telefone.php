<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = [
        'contato_id', 'telefone_comercial', 'telefone_residencial', 'telefone_celular'
    ];

    public function contato()
    {
        return $this->belongsTo(Contato::class);
    }
}

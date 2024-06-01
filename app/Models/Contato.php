<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo', 'cpf', 'email', 'data_nascimento'
    ];
    protected $dates = [
        'data_nascimento',
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }
}

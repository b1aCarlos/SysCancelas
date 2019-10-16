<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculo';

    protected $primaryKey = 'veiculo_id';

    
    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'ultima_atualizacao';
}

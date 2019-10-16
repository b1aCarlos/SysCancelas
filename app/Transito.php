<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transito extends Model
{
    protected $table = 'transito';

    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'ultima_atualizacao';
}

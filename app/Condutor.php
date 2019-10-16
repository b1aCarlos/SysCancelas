<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condutor extends Model
{    
    use SoftDeletes;


    protected $primaryKey = 'condutor_id';

    protected $table = 'condutor';
    protected $dates = ['data_de_exclusao'];

    const CREATED_AT = 'data_de_criacao';
    const UPDATED_AT = 'ultima_atualizacao';
    const DELETED_AT = 'data_de_exclusao';
}

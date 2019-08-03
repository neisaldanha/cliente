<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'CODCLIENTE';
    protected $fillable = ['CODCLIENTE','TIPO','CPF_CNPJ','DES_NOME','DT_NASCIMENTO','DES_RAZAO','CTT_FONE','CTT_CELULAR',
                           'CTT_EMAIL','CEP','ESTADO','CIDADE','END_BAIRRO','END_LOGRADOURO','NUMERO','REF',
                           'created_at','updated_at'];
}

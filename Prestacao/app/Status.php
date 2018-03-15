<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = array('numero','emissao','valor','Descontos','Total','codFornecedor','codLanca','codStatus');
	protected $table = 'tblstatus';
	
	public function NotaFiscal() {
        return $this->hasMany('NotaFiscal','codNota');
    }
}

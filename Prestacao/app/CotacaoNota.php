<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotacaoNota extends Model
{
    protected $fillable = array('codCotacao','codNota');
	protected $table = 'tblcotacaonota';
	
	public function Cotacao() {
        return $this->belongsTo('Cotacao');
    }
	
	public function NotaFiscal() {
        return $this->belongsTo('NotaFiscal');
    }
	
}

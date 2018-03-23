<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
     protected $fillable = array('cep','rua','bairro','cidade','estado','codMantenedor','codUnidade','codDre');
	 protected $table = 'tblendereco';
	 
	public function Mantenedor() 
	{
		return $this->hasOne('Mantenedor','codMantenedor'); 		
    }
	
	public function DRE() 
	{
		return $this->hasOne('DRE','codDRE'); 		
    }
	
	public function Unidade() 
	{
		return $this->hasOne('Unidade','codUnidade'); 		
    }
	
	public static function cadastraEndereco($dados)
	{
		$endereco = new Endereco;
		$endereco->cep=$dados['cep'];
		$endereco->cidade=$dados['cidade'];
		$endereco->rua=$dados['rua'];
		$endereco->estado=$dados['uf'];
		$endereco->bairro=$dados['bairro'];
		$endereco->ibge=$dados['ibge'];
		$endereco->save();
		return $endereco->id;
		
		
	}
}

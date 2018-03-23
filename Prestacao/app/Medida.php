<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
	protected $fillable = array('medida');
	protected $table = 'tblmedida';
	
	public function ProdutosNota()
	{
        return $this->hasMany('ProdutosNota','codMedida');
    }
	
	public function CotacaoProduto()
	{
        return $this->hasMany('CotacaoProduto','codMedida');
    }
	
	public static function cadastroMedida($dados)
	{
		$medida = new Medida(); 
		$medida->medida = $dados['medida'];
		$medida-> save(); //inserindo dados na base  
		return $medida; 
	}
	
	public static function visualizaDados()
	{
		$medida=\DB::table('tblmedida')
			->select(\DB::raw('*'))
			->get();
		$html='<option value="">Selecione...</option>';
		foreach ($medida as $medida) 
		{
			$html.='<option value="'.$medida->id.'">'.$medida->medida.'</option>';
		}
		return $html;
	}
}

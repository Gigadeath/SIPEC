<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProduto extends Model
{
    protected $fillable = array('tipo');
	protected $table = 'tbltipoproduto';
	
	public function Produtos()
	{
        return $this->hasMany('Produto','codTipoProduto');
    }
	public static function cadastroTipoProduto($dados)
	{
		$dados['tipo'] = 'Normal'; 
		$dados['tipo'] = 'Restrito'; 
		$tipoProduto = new TipoProduto(); 
		$tipoProduto->tipo = $dados['tipo'];
		$tipoProduto-> save(); //inserindo dados na base  
		return $tipoProduto; 
	}
	
	public static function visualizaDados()
	{
		$tipo=\DB::table('tbltipoproduto')
			->select(\DB::raw('*'))
			->get();
				
		$html='<option value="0">Selecione...</option>';
		
		
		foreach ($tipo as $tipo) 
		{
			$html.='<option value="'.$tipo->id.'">'.$tipo->tipo.'</option>';
		}
		return $html;
	}
}


<?php

namespace App;
use App\Http\Controllers\IndexController;
use Illuminate\Database\Eloquent\Model;
use Session;
use App\CotacaoProduto;

class CotacaoProduto extends Model
{
    protected $fillable = array('codCotacao','codProduto','codMedida','qtde','valorUnit','Data_Limite');
	protected $table = 'tblcotacaoproduto';
	
	
	public function Cotacao() 
	{
		 return $this->belongsTo('App\Cotacao','codCotacao');
    }
	
	public function Produto() 
	{
		 return $this->belongsTo('App\Produto','codProduto');
    }
	public function Medida() 
	{
        return $this->belongsTo('App\Medida','codMedida');
    }
	
	public static function cadastroCotacaoProduto($id,$dados)
	{
		\DB::beginTransaction();
		for($count =0;isset($dados['codProduto'][$count])==true;$count++)
		{
							$produto=\DB::table('tblproduto')
							->select(\DB::raw('count(*) as contador'))
							->where('id','=',isset($dados['codProduto'])==true ? $dados['codProduto'] : null)
							->value('contador');
									
									
										Try
										{
											// atribuindo os dados nos atributos 
											$cotacaoProduto = new CotacaoProduto(); 
											$cotacaoProduto->qtde = $dados['qtde'][$count];
											$cotacaoProduto->valorUnit = $dados['valorunit'][$count];
											$cotacaoProduto->Data_Limite =$dados['Data_Limite'][$count];
											$medida=Medida::find($dados['codMedida'][$count])->id;
											$cotacaoProduto->Medida()->associate($medida);
											$produto=Produto::find($dados['codProduto'][$count])->id;
											$cotacaoProduto->Produto()->associate($produto);
											$cotacao=Cotacao::find($id)->id;
											$cotacaoProduto->Cotacao()->associate($cotacao);
											$cotacaoProduto-> save(); //inserindo dados na base
										}catch(\Error $e)
										{
											\DB::rollBack();
											return false;
										}
									
		}
		
		\DB::commit();
		return true;
		
	} 
}

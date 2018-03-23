<?php

namespace App;
use App\Http\Controllers\IndexController;
use Illuminate\Database\Eloquent\Model;
use Session;
use App\CotacaoProduto;

class Cotacao extends Model
{
    protected $fillable = array('codFornecedor','data','total','Gasto','desconto');
	protected $table = 'tblcotacao';
	
	
	public function Fornecedor() 
	{
        return $this->belongsTo('App\Fornecedor','codFornecedor');
    }
	
	public function Lancamento() 
	{
        return $this->hasmany('App\Lancamento','codLancamento');
    }
	
	public function CotacaoProduto() 
	{
		return $this->hasMany('App\CotacaoProduto'); 
    }
	
	public function CotacaoNota() 
	{
		return $this->hasMany('App\CotacaoNota','codCotacao'); 
    }
	
	public static function cadastroCotacao($dados)
	{	
		$fornecedor=Fornecedor::select(\DB::raw('count(*) as contador'))
							->where('id','=',isset($dados['codFornecedor'])==true ? $dados['codFornecedor'] : null)
							->value('contador');
					
					 
		if($fornecedor>0)
		{
			if($dados['total']>0)
			{
				Try
				{
									// atribuindo os dados nos atributos 
					\DB::beginTransaction();
					$cotacao = new Cotacao(); 
					$cotacao->data = $dados['data'];
					$cotacao->desconto = $dados['desconto'];
					$total = str_replace('.','',$dados['total']);
					$total = str_replace(',','.',$total);
					$cotacao->total = $total;
					$cotacao->Gasto = 0;
					$fornecedor=Fornecedor::find($dados['codFornecedor'])->id;
					$cotacao->Fornecedor()->associate($fornecedor);
					$cotacao->save(); //inserindo dados na base
					$status = CotacaoProduto::cadastroCotacaoProduto($cotacao->id,$dados);
					if ($status ==true)
					{
						\DB::commit();
					}else
					{
						\DB::rollBack();
						Session::put('dados', $dados);//em caso de exce??o retorna dados
						Session::put('erro','6');// erro 
						return IndexController::Message('alert','Produto Invalido','prestacao/public/CadCotacao');
					}

									
					return IndexController::Message('success', "Cotacão Cadastrada com sucesso ", 'prestacao/public/CadCotacao');// mensagem ao usuario  
				}catch(\Error $e)
				{
					echo $e->getMessage();
					\DB::rollBack();
					Session::put('dados', $dados);//em caso de exce??o retorna dados
					Session::put('erro','6');// erro 
					return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadCotacao');
				}
			} else
			{
				//Session::put('dados', $dados);
				//Session::put('erro','1');
				return IndexController::Message('alert','Total Invalido ','prestacao/public/CadCotacao'); 
			}
		}else
		{
			// if fornecedor
			return IndexController::Message('alert','Fornecedor Invalido ','prestacao/public/CadCotacao'); 
		}
				
		
	}
}

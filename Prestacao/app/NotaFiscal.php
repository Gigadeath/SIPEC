<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\IndexController;

class NotaFiscal extends Model
{
    protected $fillable = array('numero','emissao','Descontos','Total','Gasto','codFornecedor','codLanca','codStatus');
	protected $table = 'tblnotafiscal';
	
	public function Lancamento() 
	{
        return $this->belongsTo('App\Lancamento','codLanca');
    }
	
	public function Fornecedor() 
	{
        return $this->belongsTo('App\Fornecedor','codFornecedor');
    }
	
	public function ProdutosNota()
	{
        return $this->hasMany('App\ProdutosNota','codNota');
    }
	
	public function CotacaoProduto()
	{
        return $this->hasMany('App\CotacaoNota','codNota');
    }
	
	public function Status() 
	{
        return $this->belongsTo('App\Status','codStatus');
    }
	
	public static function cadastraNota($dados,$id)
	{
		\DB::beginTransaction();
		$fornecedor=Fornecedor::where('id','=',$dados['fornecedor'])->count();
						
					if($fornecedor > 0)
					{
							if(Validacao::validaData($dados['Data'],'Y-m-d')==true) 
							{	
								// atribuindo os dados nos atributos 
								$nota = new NotaFiscal(); 
								$nota->codLanca = $id;
								$nota->numero = $dados['Nota'];
								$nota->emissao=$dados['Data'];
								$forn=Fornecedor::find($dados['fornecedor'])->id;
								$nota->Fornecedor()->associate($forn);
								$nota->Descontos=$dados['desconto'];
								$total= str_replace('R$ ','', $dados['total']);
								$total= str_replace('.','', $total);
								$total= str_replace(',','.', $total);
								$nota->Total=$total;
								$nota->codStatus=1;
								$nota->save(); //inserindo dados na base
								$status = ProdutosNota::cadastraProdutosNota($dados,$nota->id);	
								if ($status ==true)
								{
									\DB::commit();
								}else
								{
									\DB::rollBack();
									Session::put('dados', $dados);//em caso de exce??o retorna dados
									Session::put('erro','6');// erro 
									return IndexController::Message('alert','Produto Invalido','/prestacao/public/CadNota/'.Session::get('id'));	
								}
							}else
							{
								//erro no cep
								Session::put('dados', $dados);
								Session::put('erro','3');
								header('HTTP/1.1 500 Internal Server Booboo');
								header('Content-Type: application/json; charset=UTF-8');
								die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
								return IndexController::Message('alert',' selecione um tipo de produto ','prestacao/public/CadNota/'.Session::get('id')); 
							}
					}else
					{
						Session::put('dados', $dados);
						Session::put('erro','1');
						header('HTTP/1.1 500 Internal Server Booboo');
						header('Content-Type: application/json; charset=UTF-8');
						die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
						return IndexController::Message('alert','Nome invalido ','prestacao/public/CadNota/'.Session::get('id')); 
					}
		\DB::commit();
		return IndexController::Message('success','produto cadastrado com sucesso', 'prestacao/public/CadNota/'.Session::get('id'));// mensagem ao usuario  
	}
		
}


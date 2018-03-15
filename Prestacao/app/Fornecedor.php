<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController;
use Session;

class Fornecedor extends Model
{
	protected $fillable = array('cnpj','nome','cep','endereco','telefone','email');
	protected $table = 'tblfornecedor';
	
	public function NotaFiscal() {
        return $this->hasMany('App\NotaFiscal','codFornecedor');
    }
	
	public function Cotacoes() {
        return $this->hasMany('App\Cotacao','codFornecedor');
    }
	// realiza o cadastro do Fornecedor
	public static function cadastraFornecedor($dados)
	{
		//verifica se o CNPJ é valido
		if(Validacao::validaCNPJ($dados['CNPJ']) ==true)
		{
			//verifica se o Email é valido
			if (Validacao::validaEmail($dados['email'])==true )
			{
				// Verifica se o CEP e valido
				if (Validacao::validaCEP($dados['cep'])==true)
				{
					//verifica se o nome contem mais de 4 caracteres
					if (strlen($dados['nome'])>=5)
					{	//verifica se o telefone e valido
						if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)
						{
							try 
							{
								//verifica se os dados não estão em outra tabela
								if(Validacao::validaCadastroEmpresa($dados,0) ==true)
								{	
									\DB::beginTransaction();
									//Intancia fornecedor
									$fornecedor = new Fornecedor;
									//seta variaveis
									$fornecedor->cnpj=$dados['CNPJ'];
									$fornecedor->nome = $dados['nome'];
									$fornecedor->telefone = $dados['telefone'];
									$fornecedor->email = $dados['email'];
									$fornecedor->codEndereco = Endereco::cadastraEndereco($dados);
									//fim set
									$fornecedor->save();
									\DB::commit();
									//salva dados
									return IndexController::Message('success','Cadastro Concluido com sucesso','prestacao/public/CadFornecedor');
									//retorna sucesso a tela
								}
								else
								{//se não passar pelo validador de dados
									if(Session::has('tipoErro'))
									{
										//verifica a sessão do tipo erro
										$tipoerro=Session::get('tipoErro');
										//retorna mensagem
										return IndexController::Message('alert',$tipoerro,'prestacao/public/CadFornecedor');
									}
									
								}
							}catch(\Illuminate\Database\QueryException $e) 
							{ 
								\DB::rollBack();
								//seta retorna dados a variavel
								Session::put('dados', $dados);
								//identifica o código do erro
								Session::put('erro','6');
								//retorna alerta
								return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadFornecedor');
								
								
								/*if(strpos($e->getMessage(),'SQLSTATE[23000]')!==false)
								{
									Session::put('dados', $dados);
									Session::put('erro','6');
									return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadFornecedor');
									
								}*/
							}
						}else
						{//erro no telefone
							Session::put('dados', $dados);
							Session::put('erro','5');
							return IndexController::Message('alert','Telefone Incorreto','prestacao/public/CadFornecedor');
							
						}
					}else
					{
						//erro no nome
						Session::put('dados', $dados);
						Session::put('erro','4');
						return IndexController::Message('alert','Minimo de 5 letras para nome','prestacao/public/CadFornecedor');
					}
				}else
				{
						//erro no cep
						Session::put('dados', $dados);
						Session::put('erro','3');
						return IndexController::Message('alert','cep incorreto.... digite um cep válido','prestacao/public/CadFornecedor');
				}
			}else
			{
				//erro no email
				Session::put('dados', $dados);
				Session::put('erro','2');
				return IndexController::Message('alert','email incorreto.... digite um email válido','prestacao/public/CadFornecedor');
			}
		}
		else
		{
			//erro no CNPJ
			Session::put('dados', $dados);
			Session::put('erro','1');
			return IndexController::Message('alert','CNPJ incorreto...digite um CNPJ valido','prestacao/public/CadFornecedor');
		}
		
	}
		public static function visualizaDados($combo)
		{
			$count=0;
			$fornecedor=Fornecedor::all();
				
			$combo == $count ? $html='<option value="" selected>Selecione...</option>' : $html='<option value="">Selecione...</option>';
		
		
			if($combo != null)
			{
				foreach ($fornecedor as $fornecedor) 
				{
					$count++;
					
					$combo == $count ? $html.='<option value="'.$fornecedor->id.'" selected>'.$fornecedor->nome.'</option>' : $html.='<option value="'.$fornecedor->id.'">'.$fornecedor->nome.'</option>';
					
				}
			}
			else
			{
				foreach ($fornecedor as $fornecedor) 
				{
					$html.='<option value="'.$fornecedor->id.'">'.$fornecedor->nome.'</option>';;
				}
	
			}
			echo $html;
		}
}


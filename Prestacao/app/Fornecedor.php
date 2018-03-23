<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController;
use Session;

class Fornecedor extends Model
{
	protected $fillable = array('cnpj','nome','cep','endereco','telefone','email');
	protected $table = 'tblfornecedor';
	
	public function NotaFiscal() 
	{
        return $this->hasMany('App\NotaFiscal','codFornecedor');
    }
	
	public function Cotacoes() 
	{
        return $this->hasMany('App\Cotacao','codFornecedor');
    }
	// realiza o cadastro do Fornecedor
	public static function cadastraFornecedor($dados,$id)
	{
		if(isset($dados['cep']))
		{
			$cep=$dados['cep'];
		}
		else
		{
			$cep="00000-000";
		}
		//verifica se o CNPJ é valido
		if(Validacao::validaCNPJ($dados['CNPJ']) ==true || $id>0)
		{
			//verifica se o Email é valido
			if (Validacao::validaEmail($dados['email'])==true || $id>0)
			{
				// Verifica se o CEP e valido
				if (Validacao::validaCEP($cep)==true || $id>0)
				{
					//verifica se o nome contem mais de 4 caracteres
					if (strlen($dados['nome'])>=5)
					{	//verifica se o telefone e valido
						if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)
						{
							try 
							{
								//verifica se os dados não estão em outra tabela
								if(Validacao::validaCadastroEmpresa($dados,0) ==true || $id>0)
								{	
									\DB::beginTransaction();
									//Intancia fornecedor
									if($id>0)
									{
										$fornecedor = Fornecedor::find($id);
									}
									else
									{
										$fornecedor = new Fornecedor;
									}
									
									
									//seta variaveis
									$fornecedor->cnpj=$dados['CNPJ'];
									$fornecedor->nome = $dados['nome'];
									$fornecedor->telefone = $dados['telefone'];
									$fornecedor->email = $dados['email'];
									
									if ($id==0)
									$fornecedor->codEndereco = Endereco::cadastraEndereco($dados);
									
									
									//fim set
									$fornecedor->save();
									\DB::commit();
									//salva dados
									if($id >0)
									{
										return IndexController::Message('success','Fornecedor Alterado com sucesso','prestacao/public/CadFornecedor'); //retorna mensagem de sucess
									}
									else
									{
										return IndexController::Message('success','Fornecedor Cadastrado com sucesso','prestacao/public/CadFornecedor'); //retorna mensagem de sucess
									}
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
						{
							//erro no telefone
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
		public static function visualizaDados($id,$parameter,$combo)
		{
			
			if ($parameter=='combo')
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
				echo "<alert>".$html."</alert>";
			}	
			else
			{
				if($parameter=='table')
				{
					if(strlen($id)<=0)
					{
						if($combo==0)
							$combo=1;
						
						$final=$combo*10;
						$inicio=$final - 9;
						$fornecedor=Fornecedor::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
					}
					else
					{
						
						if($combo==0)
							$combo=1;
						
						$final=$combo*10;
						$offset=($combo-1)*10;
						$inicio=$final - 9;
						$fornecedor=Fornecedor::where('cnpj','like','%'.$id.'%')->orWhere('nome','like','%'.$id.'%')->orWhere('telefone','like','%'.$id.'%')->orWhere('email','like','%'.$id.'%')->limit(10)->offset($offset)->get();
						
					}
					
					$html="";
						foreach ($fornecedor as $for) 
						{
							$html.="<tr>";
							$html.="<td>".$for->id."</td>";
							$html.="<td>".$for->nome."</td>";
							$html.="<td>".$for->cnpj."</td>";
							$html.="<td>".$for->telefone."</td>";
							$html.="<td>".$for->email."</td>";
							$html.="<td><i class='fas fa-edit' onclick='edit(".$for->id.")'></i></td>";
							$html.="</tr>";
						}
						echo $html;
				
				}
				else
				{
					if($parameter=='page')
					{
						if($combo==0)
						{
							$combo = 1;
						}
						if(strlen($id)>0)
						{
						
							$pagination=Fornecedor::where('nome','like','%'.$id.'%')->orWhere('cpf','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->count();
							$pagination/=10;
						}
						else
						{
							$pagination=Fornecedor::count();
							$pagination/=10;
						
						}
						if($pagination > 10)
						{
				
							if($combo>=1 && $combo<=5)
							{	
								$inicio=1;
								$fim=10;
							}
							else
							{
								if($combo==ceil($pagination))
								{
									$inicio=ceil($pagination) - 9;
									$fim=ceil($pagination);
								}
								else
								{
									if($combo<=ceil($pagination) && $combo>=ceil($pagination)-4)
									{
									
										$fim=ceil($pagination);
										$inicio=ceil($pagination)-9;
									}
									else
									{
										$inicio=$combo-4;
										$fim=$combo+5;
									}
							
								}
							}
						
						}
						else
						{
							$inicio=1;
							$fim=ceil($pagination);
						}
			
						$html="<nav aria-label='Pagination'>";
						$html.=" <ul class='pagination text-center'>";
						if ($combo <=1)
						{
							$html.="<li class='pagination-first disabled'>Primeiro</li>";
							$html.="<li class='pagination-previous disabled'>Anterior</li>";
						}
						else
						{
							$previous=$combo - 1;
							$html.="<li class='pagination-first'><a href='#' onclick='loadFornecedor(1)'>Primeiro</a></li>";
							$html.="<li class='pagination-previous'><a href='#' onclick='loadFornecedor(".$previous .")'>Anterior</a></li>";
				
				
						}
						for ($count=$inicio;$fim>=$inicio;$inicio++)
						{		
							if($pagination >0 && $pagination < 1)
							{
					
								if($count==$combo)
								{
									$html.="<li class='current'><span class='show-for-sr'>You're on page</span>".$count."</li>";
								}
								else
								{
									$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadFornecedor(".$count.")'>".$count."</a></li>";
								}
							
							}
							else
							{
								if($count==$combo)
								{
									$html.="<li class='current'><span class='show-for-sr'>You're on page</span>".$count."</li>";
								}
								else
								{
									$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadFornecedor(".$count.")'>".$count."</a></li>";
								}
							}
							$count++;
						}
						if ($combo >=$pagination)
						{
							$html.="<li class='pagination-next disabled'>Próximo</li>";
							$html.="<li class='pagination-Last disabled'>Ultimo</li>";
						}
						else
						{
							$next=$combo + 1;
							$html.="<li class='pagination-next'><a href='#' onclick='loadFornecedor(".$next .")'>Próximo</a></li>";
							$html.="<li class='pagination-last'><a href='#' onclick='loadFornecedor(".ceil($pagination).")'>Ultimo</a></li>";
						}
						$html.=" </ul>";
						$html.=" </nav>";
						
						echo $html;
					}
					else
					{
						if($parameter=='update')
						{
							$count=Fornecedor::where('id',$id)->count();
							if($count>0)
							{
								$dados=Fornecedor::select('cnpj','nome','telefone','email')->where('id','=',$id)->first();
								$html="<div class='expanded row margin-top-20'>";
								$html.="<div class='columns large-3'>";
								$html.="<label>CNPJ:";
								$html.="<input type='text' name='CNPJ' class='CNPJ' placeholder='00.000.000/0000-00' value='".$dados['cnpj']."'>";
								$html.="</label><br>";
								$html.="</div>";
								$html.="<div class='columns large-3'>";
								$html.="<label>Nome:";	
								$html.="<input type='text' name='nome'  placeholder='Insira o nome' value='".$dados['nome']."'";}"'>";
								$html.="</label><br>";
								$html.="</div>";	
								$html.="<div class='columns large-3'>";
								$html.="<label>";
								$html.="<label>	Telefone:";
								$html.="<input type='text' name='telefone' class='Telefone' placeholder='(00) 0000-0000' value='".$dados['telefone']."'>";
								$html.="</div>";
								$html.="<div class='columns large-3'>";
								$html.="<label>Email:";
								$html.="<input type='text' name='email' placeholder='Insira um Email' value='".$dados['email']."'>";
								$html.="</label><br></div></div>";
		
								Session::put('Fornecedor',$id);
								echo $html;
						}
						else
						{
							//echo "<script>alert('erro');</script>";
						}
					}	
						
						
				}
				
	
			}
		}
}


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController; 
use Session;

class Dre extends Model
{
	protected $fillable = array('nome','endereco','telefone','email'); //variaveis aceitas para inser??o e consulta
	protected $table = 'tbldre';//tabela indexada a classe
	
	public function Unidades() { //liga??o
        return $this->hasMany('App\Unidade','codDre');
    }
	
	public function Funcionarios() {//liga??o
			return $this->hasMany('App\Funcionario','codDre');
	}
	
	public function Endereco() //liga??o
	{
        return $this->belongsTo('App\Endereco');
    }
	public static function cadastroDre($dados){//realiza cadastro da Dre
		if(strlen($dados['nome'])>=5)//verifica nome
		{ 
			if(Validacao::validaEmail($dados['email'])== true) //verifica email
			{
				if(Validacao::validaCEP($dados['cep'])== true) //verifica cep
				{
					if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)//verifica telefone
					{	
						
							Try
							{
								if(Validacao::validaCadastroEmpresa($dados,2) ==true)//valida se o cadastro n?o est? incluso na base
								{	
										\DB::beginTransaction();
										$dre = new Dre();//instancia DRE
										$dre->nome = $dados['nome'];//seta variaveis
										$dre->telefone = $dados['telefone'];
										$dre->email = $dados['email']; 
										$dre->codEndereco = Endereco::cadastraEndereco($dados);
										$dre->save();//insere na base
										\DB::commit();				
										return IndexController::Message('success','DRE Cadastrada com sucesso','prestacao/public/CadDre'); //retorna mensagem de sucess
								}else
								{
									return IndexController::Message('alert','DRE já cadastrada ','prestacao/public/CadDre'); //retorna que a Dre Foi j? esta cadastrada
								}
							}catch (\Illuminate\Database\QueryException $e)
							{
								\DB::rollBack();
								Session::put('dados', $dados);//em caso de exce??o retorna dados
								Session::put('erro','6');// erro 
								return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadDre');
								
								
								if(strpos($e->getMessage(),'SQLSTATE[23000]')!==false) // duplica??o de dados
								{
									Session::put('dados', $dados);
									Session::put('erro','6');
									return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadDre');
									
								}
							}
					}else
						{
							//erro no telefone
							Session::put('dados', $dados);
							Session::put('erro','4');
							return IndexController::Message('alert','erro no telefone','prestacao/public/CadDre'); 
						}	
				}else
					{
						//erro no cep
						Session::put('dados', $dados);
						Session::put('erro','3');
						return IndexController::Message('alert','erro cep ','prestacao/public/CadDre'); 
					}
			
			}else
				{
					//erro no email
					Session::put('dados', $dados);
					Session::put('erro','2');
					return IndexController::Message('alert','erro email ','prestacao/public/CadDre'); 
				}
		
		}else{
				//erro no nome
					Session::put('dados', $dados);
					Session::put('erro','1');
					return IndexController::Message('alert','erro nome DRE  ','prestacao/public/CadDre'); 
			}
	}
	
	//FINALIZAR METODO PARA GRID
	
	public static function visualizaDados($combo)//transforma a base em html
	{
		$count=0;
		$dre=Dre::all();
				
	$combo == $count ? $html='<option value="0" selected>Selecione...</option>' : $html='<option value="0">Selecione...</option>';
		
		
		if($combo != null)
		{
			foreach ($dre as $dre) 
			{
				$count++;
				
				$combo == $count ? $html.='<option value="'.$dre->id.'" selected>'.$dre->nome.'</option>' : $html.='<option value="'.$dre->id.'">'.$dre->nome.'</option>';;
				
			}
		}
		else
		{
			foreach ($dre as $dre) 
			{
				$html.='<option value="'.$dre->id.'">'.$dre->nome.'</option>';;
			}

		}
		echo $html;
		
	}if($parameter=='table')
			{
				if(strlen($id)<=0)
				{
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$inicio=$final - 9;
					$dre=Dre::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				}
				else
				{
					
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$offset=($combo-1)*10;
					$inicio=$final - 9;
					$dre=Dre::where('nome','like','%'.$id.'%')->orWhere('codTipoProduto','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->limit(10)->offset($offset)->get();
					
				}
				
				$html="";
					foreach ($produto as $fun) 
					{
						$html.="<tr>";
						$html.="<td>".$fun->id."</td>";
						$html.="<td>".$fun->nome."</td>";
						$html.="<td>".$fun->cpf."</td>";
						$html.="<td>Nada</td>";
						$html.="</tr>";
					}
					echo $html;
				
			}
			

		}
			
			
	}
	
	public static function Page($id,$combo)
	{

		if($combo==0)
		{
			$combo = 1;
		}
		if(strlen($id)>0)
		{
			
			$pagination=Produto::where('nome','like','%'.$id.'%')->orWhere('codTipoProduto','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->count();
			$pagination/=10;
		}
		else
		{
			$pagination=Produto::count();
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
			$html.="<li class='pagination-first'><a href='#' onclick='loadProdutos(1)'>Primeiro</a></li>";
			$html.="<li class='pagination-previous'><a href='#' onclick='loadProdutos(".$previous .")'>Anterior</a></li>";
			
			
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
					$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadProdutos(".$count.")'>".$count."</a></li>";
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
					$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadProdutos(".$count.")'>".$count."</a></li>";
				}
			}
			$count++;
		}
		if ($combo >=$pagination)
		{
			$html.="<li class='pagination-next disabled'>Pr?ximo</li>";
			$html.="<li class='pagination-Last disabled'>Ultimo</li>";
		}
		else
		{
			$next=$combo + 1;
			$html.="<li class='pagination-next'><a href='#' onclick='loadProdutos(".$next .")'>Pr?ximo</a></li>";
			$html.="<li class='pagination-last'><a href='#' onclick='loadProdutos(".ceil($pagination).")'>Ultimo</a></li>";
		}
		$html.=" </ul>";
		$html.=" </nav>";
		
		echo $html;
		
		
	}
}
}
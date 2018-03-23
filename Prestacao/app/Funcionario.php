<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController; 
use Session;

class Funcionario extends Model
{
    protected $fillable = array('nome','cpf');
	protected $table = 'tblfuncionario';
	
	
	public function Diretor()
	{
		return $this->hasOne('Funcionario','codDiretor');
		 			
	}
	
	public function Coordenador()
	{
		return $this->hasOne('Unidade','codCoordenador');
	}
	
	public function DRE()
	{
		return $this->belongsTo('DRE'); 		
	}
	
	//metodo cadastroFuncionario 
	public static function cadastroFuncionario($dados,$id)
	{	
		\DB::beginTransaction();
	
		//bloco de validações 
		if(strlen($dados['nome'])>=5 )
		{
			
			if(Validacao::validaCPF($dados['cpf'],$id)== true || $id > 0) 
			{	
				Try
				{
					// atribuindo os dados nos atributos 
				
					if($id > 0)
					{
						$funcionario = Funcionario::find($id); 
					}	
					else
					{
						$funcionario =  new Funcionario;
					}	
					$funcionario->nome = $dados['nome']; 
					$funcionario->cpf = $dados['cpf']; 
					$funcionario->save(); //inserindo dados na base  
					\DB::commit();
					if($id > 0)
					{
						return IndexController::Message('success','Funcionario Alterado com sucesso', 'prestacao/public/CadFuncionario');// mensagem ao usuario  
					}
					else
					{
						return IndexController::Message('success','Funcionario Cadastrado com sucesso', 'prestacao/public/CadFuncionario');
					}
				}
				catch(\Error $e)
				{
					
					\DB::rollBack();
					Session::put('dados', $dados);
					Session::put('erro','6');
					return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadFuncionario');
				}
				catch(\Throwable $e)
				{
					\DB::rollBack();
					echo "<script>alert('".$e->getMessage()."')</script>";
					Session::put('dados', $dados);//em caso de exce??o retorna dados
					Session::put('erro','6');// erro 
					//header('HTTP/1.1 500 Internal Server Booboo');
					//header('Content-Type: application/json; charset=UTF-8');
					//die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
					return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadFuncionario');
				}
			}else
			{
				Session::put('dados',$dados); 
				Session::put('erro','2'); 
				return IndexController::Message('alert','cpf invalido ou ja cadastrado','prestacao/public/CadFuncionario');
			}
		}else
			{
				Session::put('dados',$dados); 
				Session::put('erro','1'); 
				return IndexController::Message('alert','erro no nome','prestacao/public/CadFuncionario');
			}
	}
	
	public static function visualizaDados($id,$parameter,$combo)
	{
		if ($parameter=='combo')
		{
		
			$count=0;
			$funcionario=Funcionario::whereNotIn ('id',function ($query){
					$query->select('codCoordenador')->from('tblunidade');
					})
					->whereNotIn ('id',function ($query){
					$query->select('codDiretor')->from('tblunidade');
					})
					->get();
					
			$combo == $count ? $html='<option value="" selected>Selecione...</option>' : $html='<option value="">Selecione...</option>';
			
			if($combo != null)
			{	
				foreach ($funcionario as $funcionario) 
				{
					$count++;
					
					$combo == $count ? $html.='<option value="'.$funcionario->id.'" selected>'.$funcionario->nome.'</option>' : $html.='<option value="'.$funcionario->id.'">'.$funcionario->nome.'</option>';;
					
				}
				echo $html;
			}
			else
			{
				foreach ($funcionario as $funcionario) 
				{
					$html.='<option value="'.$funcionario->id.'">'.$funcionario->nome.'</option>';;
				}
				echo $html;
			}
			
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
					$funcionario=Funcionario::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				}
				else
				{
					
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$offset=($combo-1)*10;
					$inicio=$final - 9;
					$funcionario=Funcionario::where('nome','like','%'.$id.'%')->orWhere('cpf','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->limit(10)->offset($offset)->get();
					
				}
				
				$html="";
					foreach ($funcionario as $fun) 
					{
						$html.="<tr>";
						$html.="<td>".$fun->id."</td>";
						$html.="<td>".$fun->nome."</td>";
						$html.="<td>".$fun->cpf."</td>";
						$html.="<td><i class='fas fa-edit' onclick='edit(".$fun->id.")'></i></td>";
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
						$pagination=Funcionario::where('nome','like','%'.$id.'%')->orWhere('cpf','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->count();
						$pagination/=10;
					}
					else
					{
						$pagination=Funcionario::count();
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
						$html.="<li class='pagination-first'><a href='#' onclick='loadFuncionarios(1)'>Primeiro</a></li>";
						$html.="<li class='pagination-previous'><a href='#' onclick='loadFuncionarios(".$previous .")'>Anterior</a></li>";
			
			
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadFuncionarios(".$count.")'>".$count."</a></li>";
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadFuncionarios(".$count.")'>".$count."</a></li>";
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
						$html.="<li class='pagination-next'><a href='#' onclick='loadFuncionarios(".$next .")'>Próximo</a></li>";
						$html.="<li class='pagination-last'><a href='#' onclick='loadFuncionarios(".ceil($pagination).")'>Ultimo</a></li>";
					}
					$html.=" </ul>";
					$html.=" </nav>";
					
					echo $html;
				}
				else
				{
					if($parameter=='update')
					{
						$count=Funcionario::where('id',$id)->count();
						if($count>0)
						{
							$dados=Funcionario::select('nome','cpf')->where('id','=',$id)->first();
							$html="<div class='columns large-4'>";        
							$html.="<label>Nome:";
							$html.="<input type='text' name='nome' placeholder='Insira o Cpf 'value='".$dados->nome."'>";
							$html.="</label><br>";
							$html.="</div>";
							$html.="<div class='columns large-4'>";
							$html.="<label>CPF:";
							$html.="<input type='text' name='cpf' class='CPF' placeholder='000.000.000-00' value='".$dados->cpf."'>";
							$html.="</label><br>";
							$html.="<p class='help-text' id='passwordHelpText'>use somente numeros neste campo.</p>";
							$html.="</div>";
							Session::put('Funcionario',$id);
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
}
		


<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IndexController;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use App\Mantenedor;
use Session;
class Mantenedor extends Model
{
    protected $fillable = array('id','cnpj', 'nome','telefone','email');
	protected $table = 'tblmantenedor';
	
	
	public function Unidade() 
	{
        return $this->hasOne('App\Unidade','codMantenedor'); 
    }
	
	public function Endereco() 
	{
        return $this->belongsTo('App\Endereco');
    }
	
	public static function cadastraMantenedor($dados,$id)
	{
		if(isset($dados['cep']))
		{
			$cep=$dados['cep'];
		}
		else
		{
			$cep="00000-000";
		}
		if(Validacao::validaCNPJ($dados['CNPJ']) ==true || $id>0)
		{
			if (Validacao::validaEmail($dados['email'])==true || $id>0 )
			{
				if (Validacao::validaCEP($cep)==true || $id>0)
				{
					
					if (strlen($dados['nome'])>=5)
					{	
						if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)
						{
							try 
							{
								if(Validacao::validaCadastroEmpresa($dados,0) ==true || $id>0)
								{
									\DB::beginTransaction();
									if($id >0)
									{
										$mantenedor = Mantenedor::find($id);
									}else
									{
										$mantenedor = new Mantenedor;										
									}
									$mantenedor->cnpj=$dados['CNPJ'];
									$mantenedor->nome = $dados['nome'];
									$mantenedor->telefone = $dados['telefone'];
									$mantenedor->email = $dados['email'];
									
									if($id == 0)
									$mantenedor->codEndereco = Endereco::cadastraEndereco($dados);
								
									$mantenedor->save();
									\DB::commit();
									if($id >0)
									{
										return IndexController::Message('success','Mantenedor Alterada com sucesso','prestacao/public/CadMantenedora'); //retorna mensagem de sucess
									}else
									{
										return IndexController::Message('success','Mantenedor Cadastrada com sucesso','prestacao/public/CadMantenedora'); //retorna mensagem de sucess
									}
									
								}
								else
								{
									if(Session::has('tipoErro'))
									{
										$tipoerro=Session::get('tipoErro');
										return IndexController::Message('alert',$tipoerro,'prestacao/public/CadMantenedora');
									}
									
								}
							}catch(Error $e) 
							{ 
								\DB::rollBack();
								Session::put('dados', $dados);
								Session::put('erro','6');
								return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadMantenedora');
							}catch(Throwable $e) {
								return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadMantenedora');
							}
						}else
						{
							Session::put('dados', $dados);
							Session::put('erro','5');
							return IndexController::Message('alert','Telefone Incorreto','prestacao/public/CadMantenedora');
							
						}
					}else
					{
						Session::put('dados', $dados);
						Session::put('erro','4');
						return IndexController::Message('alert','Minimo de 5 letras para nome','prestacao/public/CadMantenedora');
					}
				}else
				{
						Session::put('dados', $dados);
						Session::put('erro','3');
						return IndexController::Message('alert','cep incorreto.... digite um cep válido','prestacao/public/CadMantenedora');
				}
			}else
			{
				Session::put('dados', $dados);
				Session::put('erro','2');
				return IndexController::Message('alert','email incorreto.... digite um email válido','prestacao/public/CadMantenedora');
			}
		}
		else
		{
			Session::put('dados', $dados);
			Session::put('erro','1');
			return IndexController::Message('alert','CNPJ incorreto...digite um CNPJ valido','prestacao/public/CadMantenedora');
		}
		
	}
	
	public static function visualizaDados($id,$parameter,$combo)
	{
		
		if ($parameter=='combo')
		{
		
			$count=0;
			$mantenedor=Mantenedor::all();
			$combo == $count ? $html='<option value="0" selected>Selecione...</option>' : $html='<option value="0">Selecione...</option>';
			if($combo != null)
			{
				foreach ($mantenedor as $mantenedor) 
				{
					$count++;
					$combo == $count ? $html.='<option value="'.$mantenedor->id.'" selected>'.$mantenedor->nome.'</option>' : $html.='<option value="'.$mantenedor->id.'">'.$mantenedor->nome.'</option>';;
				}
			}
			else
			{
				foreach ($mantenedor as $mantenedor) 
				{
					$html.='<option value="'.$mantenedor->id.'">'.$mantenedor->nome.'</option>';;
				}
			}
			echo $html;
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
					$mantenedor=Mantenedor::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				}
				else
				{
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$offset=($combo-1)*10;
					$inicio=$final - 9;
					$mantenedor=Mantenedor::where('CNPJ','like','%'.$id.'%')->orWhere('nome','like','%'.$id.'%')->orWhere('telefone','like','%'.$id.'%')->orWhere('email','like','%'.$id.'%')->limit(10)->offset($offset)->get();
				}
				
				$html="";
				foreach ($mantenedor as $man) 
				{
					$html.="<tr>";
					$html.="<td>".$man->id."</td>";
					$html.="<td>".$man->nome."</td>";
					$html.="<td>".$man->cnpj."</td>";
					$html.="<td>".$man->telefone."</td>";
					$html.="<td>".$man->email."</td>";
					$html.="<td><i class='fas fa-edit' onclick='edit(".$man->id.")'></i></td>";
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
						$pagination=Mantenedor::where('nome','like','%'.$id.'%')->orWhere('cpf','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->count();
						$pagination/=10;
					}
					else
					{
						$pagination=Mantenedor::count();
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
						$html.="<li class='pagination-first'><a href='#' onclick='loadMantenedor(1)'>Primeiro</a></li>";
						$html.="<li class='pagination-previous'><a href='#' onclick='loadMantenedor(".$previous .")'>Anterior</a></li>";
			
			
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadMantenedor(".$count.")'>".$count."</a></li>";
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadMantenedor(".$count.")'>".$count."</a></li>";
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
						$html.="<li class='pagination-next'><a href='#' onclick='loadMantenedor(".$next .")'>Próximo</a></li>";
						$html.="<li class='pagination-last'><a href='#' onclick='loadMantenedor(".ceil($pagination).")'>Ultimo</a></li>";
					}
					$html.=" </ul>";
					$html.=" </nav>";
					
					echo $html;
				}
				else
				{
					if($parameter=='update')
					{
						$count=Mantenedor::where('id',$id)->count();
						if($count>0)
						{
							$dados=Mantenedor::select('cnpj','nome','telefone','email')->where('id','=',$id)->first();
							$html="<div class='expanded row margin-top-20'>";
							$html.="<div class='columns large-3'>";
							$html.="<label>CNPJ:";
							$html.="<input type='text' name='CNPJ' class='CNPJ' placeholder='00.000.000/0000-00' value='".$dados['cnpj']."'>";
							$html.="</label><br>";
							$html.="</div>";
							$html.="<div class='columns large-3'>";
							$html.="<label>Nome:";	
							$html.="<input type='text' name='nome'  placeholder='Insira o nome' value='".$dados['nome']."'";"'>";
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
							Session::put('Mantenedor',$id);
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




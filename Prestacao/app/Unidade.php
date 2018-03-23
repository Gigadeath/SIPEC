<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController; 
use Session;


class Unidade extends Model
{
    protected $fillable = array('eol','nome','inep','cnpj','telefone1','telefone2','email','fax','codMantenedor','codDre','codDiretor','codCoordenador','latitude','longitude','codEndereco');
	protected $table = 'tblunidade';
	
	public function Mantenedor() 
	{
        return $this->belongsTo('App\Mantenedor','codMantenedor');
    }
	
	public function Diretor() 
	{
		return $this->belongsTo('App\Funcionario','codDiretor');
    }
	
	public function Coordenador() 
	{
		return $this->belongsTo('App\Funcionario','codCoordenador');	
    }
	
	public function Dre() 
	{
        return $this->belongsTo('App\Dre','codDre');
    }
	
	public function lancamentos() {
        return $this->hasMany('lancamento','codUnid');
    }
	
	public function Endereco() 
	{
        return $this->belongsTo('App\Endereco','codEndereco');
    }
	
	public static function cadastraUnidade($dados,$id)
	{
		 
		/*if(Validacao::validaCNPJ($dados['CNPJ']) ==true)
		{
			if (Validacao::validaEmail($dados['email'])==true )
			{
				if (Validacao::validaCEP($dados['cep'])==true)
				{
					
					if (strlen($dados['nome'])>=5)
					{	
						if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)
						{*/
							try 
							{
								//if(Validacao::validaCadastroEmpresa($dados,0) ==true)
								//{
									\DB::beginTransaction();
									if($id > 0 )
										{
											$unidade = Unidade::find($id); 
										}
										else
										{
											$unidade = new Unidade();//instancia DRE
										}
									$unidade->eol=$dados['eol'];
									$unidade->nome=$dados['nome'];
									$unidade->email=$dados['email'];
									$unidade->fax = $dados['fax'];
									$unidade->inep=$dados['inep'];
									$unidade->telefone1 = $dados['telefone'];
									$mantenedor = Mantenedor::find($dados['mantenedor'])->id;
									$unidade->Mantenedor()->associate($mantenedor);
									$coordenador=Funcionario::find($dados['coordenador'])->id;
									$unidade->Coordenador()->associate($coordenador);
									$unidade->CNPJ=$dados['CNPJ'];
									$unidade->telefone2 = $dados['telefone2'];
									$dre=DRE::find($dados['dre'])->id;
									$unidade->Dre()->associate($dre);
									$diretor=Funcionario::find($dados['diretor'])->id;
									$unidade->Diretor()->associate($diretor);
									$unidade->situacao=1;
									//$geocode= Validacao::LatLong($dados['cep']);
									$unidade->latitude = " -22.18379021" ;// $geocode['latitude'];
									$unidade->longitude  = "-47.37314987" ;//$geocode['longitude'];
									$unidade->Endereco()->associate(Endereco::cadastraEndereco($dados));
									
									$unidade->save();
									\DB::commit();
									return IndexController::Message('success','Cadastro Concluido com sucesso','prestacao/public/CadUnidade');
								/*}
								else
								{
									if(Session::has('tipoErro'))
									{
										Session::put('dados', $dados);
										Session::put('erro','6');
										$tipoerro=Session::get('tipoErro');
										//return IndexController::Message('alert',$tipoerro,'prestacao/public/CadUnidade');
										
									}*/
									
								/*}
							}catch(\Error $e) 
							{ 
								\DB::rollBack();
								Session::put('dados', $dados);
								Session::put('erro','6');
								//return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadUnidade');
								*/
							}catch(\Error $e) {
								print_r($_POST);
								Session::put('dados', $dados);
								Session::put('erro',$e->getMessage());
								echo $e->getMessage();
								\DB::rollBack();
								return IndexController::Message('alert',"Erro",'prestacao/public/CadUnidade');
							}
						/*}else
						{
							Session::put('dados', $dados);
							Session::put('erro','5');
							return IndexController::Message('alert','Telefone Incorreto','prestacao/public/CadUnidade');
							
						}
					}else
					{
						Session::put('dados', $dados);
						Session::put('erro','4');
						return IndexController::Message('alert','Minimo de 5 letras para nome','prestacao/public/CadUnidade');
					}
				}else
				{
						Session::put('dados', $dados);
						Session::put('erro','3');
						return IndexController::Message('alert','cep incorreto.... digite um cep válido','prestacao/public/CadUnidade');
				}
			}else
			{
				Session::put('dados', $dados);
				Session::put('erro','2');
				return IndexController::Message('alert','email incorreto.... digite um email válido','prestacao/public/CadUnidade');
			}
		}
		else
		{
			Session::put('dados', $dados);
			Session::put('erro','1');
			return IndexController::Message('alert','CNPJ incorreto...digite um CNPJ valido','prestacao/public/CadUnidade');
		}*/
		
	}

public static function visualizaDados($id,$parameter,$combo)
	{
		
		if ($parameter=='combo')
		{
		
			$unidade=Unidade::all();
				
		$html='<option value="">Selecione...</option>';
		
		
		foreach ($unidade as $unidade) 
		{
			$html.='<option value="'.$unidade->id.'">'.$unidade->nome.'</option>';
		}
		return $html;
			
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
					$unidade=Unidade::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				}
				else
				{
					
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$offset=($combo-1)*10;
					$inicio=$final - 9;
					$unidade=Unidade::where('nome','like','%'.$id.'%')->orWhere('eol','like','%'.$id.'%')->get();
					
				}
				$html="";
					foreach ($unidade as $uni) 
					{
						$html.="<tr>";
						$html.="<td>".$uni->id."</td>";
						$html.="<td>".$uni->nome."</td>";
						$html.="<td>".$uni->eol."</td>";
						$html.="<td>".$uni->inep."</td>";
						$html.="<td>".$uni->cnpj."</td>";
						$html.="<td><i class='fas fa-edit' style='cursor: pointer;' onfocus = ' javascript: setMainCursor ('hand' )' onclick='edit(".$uni->id.")'></i></td>";
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
					
						$pagination=Unidade::where('nome','like','%'.$id.'%')->orWhere('eol','like','%'.$id.'%')->orWhere('email','like','%'.$id.'%')->count();
						$pagination/=10;
					}
					else
					{
						$pagination=Unidade::count();
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
						$html.="<li class='pagination-first'><a href='#' onclick='loadUnidades(1)'>Primeiro</a></li>";
						$html.="<li class='pagination-previous'><a href='#' onclick='loadUnidades(".$previous .")'>Anterior</a></li>";
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadUnidades(".$count.")'>".$count."</a></li>";
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
								$html.="<li><a href='#' aria-label='Page ".$count."' onclick='loadUnidades(".$count.")'>".$count."</a></li>";
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
						$html.="<li class='pagination-next'><a href='#' onclick='loadUnidades(".$next .")'>Próximo</a></li>";
						$html.="<li class='pagination-last'><a href='#' onclick='loadUnidades(".ceil($pagination).")'>Ultimo</a></li>";
					}
					$html.=" </ul>";
					$html.=" </nav>";
					
					echo $html;
				}
				else
				{
					if($parameter=='update')
					{
						$mantenedor=\DB::table('tblmantenedor')
						->select(\DB::raw('*'))
						->get(); 
						$diretor=\DB::table('tblfuncionario')
						->select(\DB::raw('*'))
						->get();
						$coor=\DB::table('tblfuncionario')
						->select(\DB::raw('*'))
						->get();
						$dre=\DB::table('tbldre')
						->select(\DB::raw('*'))
						->get();
						
						$count=Unidade::where('id',$id)->count();
						if($count>0)
						{
							$dados=Unidade::select('nome','eol')->where('id','=',$id)->first();
							$html="<div class='expanded row margin-top-20'>";
							$html.="<div class='columns large-4'>";
							$html.="<label>EOL:";
							$html.="<input type='number' name='eol'  placeholder='Insira o código EOL' min='1' max='99999999' maxlength='8' value='".$dados['eol']."'>";
							$html.="</label><br><label>	Nome:";
							$html.="<input type='text' name='nome'  placeholder='Insira o nome' value='".$dados['nome']."'>";
							$html.="</label><br><label>	Email:";
							$html.="<input type='email' name='email' placeholder='Insira um Email' 'value='".$dados->email."''></label><br>";
							$html.="<label>FAX <input type='text' name='fax' class='Telefone' placeholder='55 (00) 0000-0000''value='".$dados->fax."''></label>";
							$html.="</div>"; 
							$html.="<div class='columns large-4'>";
							$html.="<label>INEP:<input type='number' name='inep' class='INEP' placeholder='00000000' min='1' min='99999999' 'value='".$dados->inep."''>"; 
							$html.="</label><br>"; 
							$html.="<label> Telefone: <input type='text' name='telefone' class='Telefone' placeholder='55 (00) 0000-0000' 'value='".$dados->telefone."''><br></label>";
							$html.="<label>Mantenedor <select id='mantenedora' name='mantenedor' 'value='".$dados->mantenedor."'' >"; 
							
							$html.='<option value="">Selecione...</option>';
							foreach ($mantenedor as $mantenedor) 
							{
							$html.='<option value="'.$mantenedor->id.'">'.$mantenedor->nome.'</option>';
							}
							$html.="</select></label><br>"; 
							$html.="<br><label>Coordenador: <select id ='coordenador'  name='coordenador' 'value='".$dados->coordenador."''>";
							
							$html.='<option value="">Selecione...</option>';
							foreach ($coor as $coor) 
							{
							$html.='<option value="'.$coor->id.'">'.$coor->nome.'</option>';
							}
							$html.="</select></label>"; 
							
							$html.="</div>"; 
							$html.="<div class='columns large-4'>";  
							$html.="<label> CNPJ: <input type='text' name='CNPJ' class='CNPJ' placeholder='00.000.000/0000-00' 'value='".$dados->cnpj."''>"; 
							$html.="</label><br><br>"; 
							$html.="<label>Telefone 2: <input type='text' name='telefone2' class='Telefone' placeholder='55 (00) 0000-0000' 'value='".$dados->telefone2."''><br></label>";
							$html.="<label>DRE: <select id ='dre'  name='dre' 'value='".$dados->dre."''>";
							
							$html.='<option value="">Selecione...</option>';
							foreach ($dre as $dre) 
							{
							$html.='<option value="'.$dre->id.'">'.$dre->nome.'</option>';
							}
							$html.="</select></label>"; 
							$html.="<br><br><label>Diretor: <select id ='diretor'  name='diretor' 'value='".$dados->diretor."''>";
							
							$html.='<option value="">Selecione...</option>';
							foreach ($diretor as $diretor) 
							{
							$html.='<option value="'.$diretor->id.'">'.$diretor->nome.'</option>';
							}
							$html.="</select></label>"; 
							$html.="</div>";
							$html.="</div>"; 
							$html.="<div class='columns large-12'>";
							$html.="<h5>Endereço</h5> </div>";
							$html.="<div class='columns large-12'>";
							$html.="<div class='columns large-4'><label>";
							$html.="CEP:<input type='text' name='cep' id='cep' class='CEP' placeholder='00000-000' onblur='pesquisacep(this.value);' 'value='".$dados['cep']."''></label><br>"; 
							$html.="<label>Cidade:<input type='text' name='cidade'  id='cidade' readonly 'value='".$dados['cidade']."''></label><br>";
							$html.="</div>";
							$html.="<div class='columns large-4'>";
							$html.="<label>Rua:<input type='text' name='rua' id='rua'  readonly 'value='".$dados['rua']."''></label><br>";
							$html.="<label>	Estado: <input type='text' name='uf' id='uf'  readonly 'value='".$dados['uf']."''></label><br>";
							$html.="</div>";
							$html.="<div class='columns large-4'>";
							$html.="<label>Bairro:<input type='text' name='bairro' id='bairro'  readonly 'value='".$dados['bairro']."''></label><br>";
							$html.="<label>IBGE:<input type='text' name='ibge' id='ibge'  readonly 'value='".$dados['ibge']."''></label><br>";
							$html.="</div>";
							$html.="</div>";
							Session::put('Unidade',$id);
							echo $html;
						}
						else
						{
							echo "<script>alert('erro');</script>";
						}
					}
					
					
				}
			

			}
		}
			
	
	}
}

		



	
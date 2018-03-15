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
	
	public static function cadastraMantenedor($dados)
	{
		if(Validacao::validaCNPJ($dados['CNPJ']) ==true)
		{
			if (Validacao::validaEmail($dados['email'])==true )
			{
				if (Validacao::validaCEP($dados['cep'])==true)
				{
					
					if (strlen($dados['nome'])>=5)
					{	
						if(strlen($dados['telefone'])>=14 && strlen($dados['telefone'])<=15)
						{
							try 
							{
								if(Validacao::validaCadastroEmpresa($dados,0) ==true)
								{
									\DB::beginTransaction();
									$mantenedor = new Mantenedor;
									$mantenedor->cnpj=$dados['CNPJ'];
									$mantenedor->nome = $dados['nome'];
									$mantenedor->telefone = $dados['telefone'];
									$mantenedor->email = $dados['email'];
									$mantenedor->codEndereco = Endereco::cadastraEndereco($dados);
									$mantenedor->save();
									\DB::commit();
									return IndexController::Message('success','Cadastro Concluido com sucesso','prestacao/public/CadMantenedora');
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
	
	public static function visualizaDados($combo)
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

}


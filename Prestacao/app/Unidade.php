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
	
	public static function cadastraUnidade($dados)
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
									$unidade = new Unidade;
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
									$geocode= Validacao::LatLong($dados['cep']);
									$unidade->latitude = $geocode['latitude'];
									$unidade->longitude  = $geocode['longitude'];
									$unidade->Endereco()->associate(Endereco::cadastraEndereco($dados));
									$unidade->save();
									\DB::commit();
									return IndexController::Message('success','Cadastro Concluido com sucesso','prestacao/public/CadUnidade');
								}
								else
								{
									if(Session::has('tipoErro'))
									{
										Session::put('dados', $dados);
										Session::put('erro','6');
										$tipoerro=Session::get('tipoErro');
										return IndexController::Message('alert',$tipoerro,'prestacao/public/CadUnidade');
										
									}
									
								}
							}catch(\Error $e) 
							{ 
								\DB::rollBack();
								Session::put('dados', $dados);
								Session::put('erro','6');
								return IndexController::Message('alert',$e->getMessage(),'prestacao/public/CadUnidade');
								
							}catch(\Throwable $e) {
								print_r($_POST);
								Session::put('dados', $dados);
								Session::put('erro',$e->getMessage());
								echo $e->getMessage();
								\DB::rollBack();
								return IndexController::Message('alert',Validacao::traduzErro($e->getMessage()),'prestacao/public/CadUnidade');
							}
						}else
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
				//return IndexController::Message('alert','email incorreto.... digite um email válido','prestacao/public/CadUnidade');
			}
		}
		else
		{
			Session::put('dados', $dados);
			Session::put('erro','1');
			return IndexController::Message('alert','CNPJ incorreto...digite um CNPJ valido','prestacao/public/CadUnidade');
		}
		
	}
}

	
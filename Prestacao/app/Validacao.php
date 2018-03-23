<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use DateTime;

class Validacao extends Model
{
   // VERIFICA CPF
	public static function validaCPF($cpf,$id) 
	{	
		if($id >0)
		{
			$funcionario=0;		
		}
		else
		{
			$funcionario=\DB::table('tblfuncionario')
					->select(\DB::raw('count(*) as contador'))
					->where('cpf','=',$cpf)
					->value('contador');
		}
		if($funcionario > 0)	//se sim
		{
			
			//seta o tipo de erro
			Session::put('tipoErro', 'CPF ja cadastrado');
			return false;//retorna nulo
		}else
		{
			if (strpos($cpf,".")==true && strpos($cpf,"-")==true)
			{
				if ($cpf =="000.000.000-00" || $cpf =="111.111.111-11" || $cpf=="222.222.222-22" || $cpf=="333.333.333-33" || $cpf=="444.444.444-44" || $cpf=="555.555.555-55" || $cpf=="666.666.666-66" || $cpf=="777.777.777-77" || $cpf=="888.888.888-88" || $cpf=="999.999.999-99")
				{
					return false;
				}
				$quebra = explode(".", $cpf);
				$quebra2=explode("-", $quebra[2]);
				$cpf=$quebra[0].$quebra[1].$quebra2[0].$quebra2[1];	
				$soma = 0;
				if (strlen($cpf) <> 11)
					return false;
				// Verifica 1º digito		
				for ($i = 0; $i < 9; $i++) 
				{			
					$soma += (($i+1) * $cpf[$i]);
				}

				$d1 = ($soma % 11);
			
				if ($d1 == 10)
				{
					$d1 = 0;
				}
				$soma = 0;
				// Verifica 2º digito
				for ($i = 9, $j = 0; $i > 0; $i--, $j++) 
				{
					$soma += ($i * $cpf[$j]);
				}
			
				$d2 = ($soma % 11);
				
				if ($d2 == 10) 
				{
					$d2 = 0;
				}		
			
				if ($d1 == $cpf[9] && $d2 == $cpf[10]) 
				{
					return true;
				}
				else 
				{
					return false;
				}
			}else
			{
				return false;
			}
		}	
	}
	
	
	
	
	
	// VERFICA CNPJ
	public static function validaCNPJ($cnpj) 
	{
		if (strpos($cnpj,".")==true && strpos($cnpj,"/")==true && strpos($cnpj,"-")==true)
		{
			if ($cnpj =="00.000.000/0000-00" || $cnpj =="11.111.111/1111-11" || $cnpj=="22.222.222/2222-22" || $cnpj=="33.333.333/3333-33" || $cnpj=="44.444.444/4444-44" || $cnpj=="55.555.555/5555-55" || $cnpj=="66.666.666/6666-66" || $cnpj=="77.777.777/7777-77" || $cnpj=="88.888.888/8888-88" || $cnpj=="99.999.999/9999-99")
			{
				return false;
			}
			else
			{
				$quebra = explode(".", $cnpj);
				$quebra2=explode("/", $quebra[2]);
				$quebra3=explode("-", $quebra2[1]);
				$cnpj=$quebra[0].$quebra[1].$quebra2[0].$quebra3[0].$quebra3[1];
				
				if (strlen($cnpj) <> 14)
					return false; 
		
				$soma = 0;
				$soma += ($cnpj[0] * 5);
				$soma += ($cnpj[1] * 4);
				$soma += ($cnpj[2] * 3);
				$soma += ($cnpj[3] * 2);
				$soma += ($cnpj[4] * 9); 
				$soma += ($cnpj[5] * 8);
				$soma += ($cnpj[6] * 7);
				$soma += ($cnpj[7] * 6);
				$soma += ($cnpj[8] * 5);
				$soma += ($cnpj[9] * 4);
				$soma += ($cnpj[10] * 3);
				$soma += ($cnpj[11] * 2); 
				$d1 = $soma % 11; 
				$d1 = $d1 < 2 ? 0 : 11 - $d1; 
				$soma = 0;
				$soma += ($cnpj[0] * 6); 
				$soma += ($cnpj[1] * 5);
				$soma += ($cnpj[2] * 4);
				$soma += ($cnpj[3] * 3);
				$soma += ($cnpj[4] * 2);
				$soma += ($cnpj[5] * 9);
				$soma += ($cnpj[6] * 8);
				$soma += ($cnpj[7] * 7);
				$soma += ($cnpj[8] * 6);
				$soma += ($cnpj[9] * 5);
				$soma += ($cnpj[10] * 4);
				$soma += ($cnpj[11] * 3);
				$soma += ($cnpj[12] * 2); 
				$d2 = $soma % 11; 
				$d2 = $d2 < 2 ? 0 : 11 - $d2; 
				
				if ($cnpj[12] == $d1 && $cnpj[13] == $d2) 
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
		}else
		{
			return false;
		}
	 }
	 
	//valida??o de email
	public static function validaEmail($mail)
	{
		if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $mail)) {
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//valida??o do CEP
	public static function validaCEP($cep)
	{
		if(preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep)) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//validacao de Cadastro $dados= valores do post e $opcao= verifica se ? uma mantenedora (0), unidade(1),dre(2)
	public static function validaCadastroEmpresa($dados,$opcao)
	{
		if ($opcao == 0 || $opcao==1)
		{
			//verifica se os dados n?o est?o na tabela fornecedor
			$fornecedor=\DB::table('tblfornecedor')
				->select(\DB::raw('count(*) as contador'))
				->where('CNPJ','=',$dados['CNPJ'])
				->orWhere('nome','=',$dados['nome'])
				->orWhere('telefone','=',$dados['telefone'])
				->orWhere('email','=',$dados['email'])->value('contador');
		}
		else
		{
			if($opcao ==2)
			{	
				//verifica se os dados n?o est?o na tabela fornecedor
				$fornecedor=\DB::table('tblfornecedor')
					->select(\DB::raw('count(*) as contador'))
					->Where('nome','=',$dados['nome'])
					->orWhere('telefone','=',$dados['telefone'])
					->orWhere('email','=',$dados['email'])->value('contador');
			}
		}
		
		if($fornecedor > 0)	//se sim
		{
			//seta o tipo de erro
			Session::put('tipoErro', 'fornecedor com os mesmos dados cadastrados');
			return false;//retorna nulo
		}
		else //sen?o
		{
			if ($opcao ==0)//se n?o for uma unidade
			{
				// se n?o for uma unidade ou mantenedora considera email
				$mantenedor=\DB::table('tblmantenedor')
					->select(\DB::raw('count(*) as contador'))
					->where('CNPJ','=',$dados['CNPJ'])
					->orWhere('nome','=',$dados['nome'])
					->orWhere('telefone','=',$dados['telefone'])
					->orWhere('email','=',$dados['email'])->value('contador');
			}
			else
			{
				if ($opcao==1)
				{
					// se for uma unidade ou mantenedora desconsidera email
					$mantenedor=\DB::table('tblmantenedor')
						->select(\DB::raw('count(*) as contador'))
						->where('CNPJ','=',$dados['CNPJ'])
						->orWhere('nome','=',$dados['nome'])
						->orWhere('telefone','=',$dados['telefone'])
						->value('contador');
				}
				else
				{
					if ($opcao==2)
					{
						// se for uma unidade ou mantenedora desconsidera email
						$mantenedor=\DB::table('tblmantenedor')
							->select(\DB::raw('count(*) as contador'))
							->Where('nome','=',$dados['nome'])
							->orWhere('email','=',$dados['email'])
							->orWhere('telefone','=',$dados['telefone'])
							->value('contador');
					}
				}
			}
			if ($mantenedor >0) //se achar algum resulltado
			{
				Session::put('tipoErro', 'mantenedor com os mesmos dados cadastrados'); //seta erro
				return false; //retorna falso
			}				
			else 
			{	
				//sen?o
				if ($opcao==0) //verifica se ? unidade ou mantenedora
				{  // se n?o for considera e-mail
					$unidade=\DB::table('tblunidade')
						->select(\DB::raw('count(*) as contador'))
						->where('CNPJ','=',$dados['CNPJ'])
						->orWhere('nome','=',$dados['nome'])
						->orWhere('telefone1','=',$dados['telefone'])
						->orWhere('email','=',$dados['email'])->value('contador');
				}
				else
				{
					if ($opcao==1)
					{
						//se for unidade ou mantenedora n?o considera e-mail
						$unidade=\DB::table('tblunidade')
							->select(\DB::raw('count(*) as contador'))
							->where('CNPJ','=',$dados['CNPJ'])
							->orWhere('nome','=',$dados['nome'])
							->orWhere('telefone1','=',$dados['telefone'])
							->value('contador');
					}
					else
					{
						if ($opcao==2)
						{
							//se for unidade ou mantenedora n?o considera e-mail
							$unidade=\DB::table('tblunidade')
								->select(\DB::raw('count(*) as contador'))
								->Where('nome','=',$dados['nome'])
								->orWhere('email','=',$dados['email'])
								->orWhere('telefone1','=',$dados['telefone'])
								->value('contador');
						}
					}
				}
			}
			//verifica se retornou algum registro
			if ($unidade > 0) //se sim
			{
				Session::put('tipoErro', 'unidade com os mesmos dados cadastrados'); //seta erro
				return false;//retorna falso
			}
			else 
			{ //sen?o verifica dre
				
				$dre=\DB::table('tbldre')
				->select(\DB::raw('count(*) as contador'))
				->orWhere('nome','=',$dados['nome'])
				->orWhere('telefone','=',$dados['telefone'])
				->orWhere('email','=',$dados['email'])->value('contador');
				// se achar alguma contagem da dre
				if ($dre >0) 
				{
					
					Session::put('tipoErro', 'dre com os mesmos dados cadastrados');//seta erro
					return false; //retorna falso
				}
				
				else // sen?o
				{
					$endereco=\DB::table('tblendereco')
					->select(\DB::raw('count(*) as contador'))
					->where('cep','=',$dados['cep'])
					->value('contador');
					
					if($endereco >0)// se consulta endereco retornar valor
					{
						
						Session::put('tipoErro', 'endereco com os mesmos dados cadastrados'); //seta erro
						return false;//retorna falso
					}
					else
					{
						return true; // sen?o retorna verdadeiro
					}
					
				}
			
			}					
		}
	}
	
	public  static function traduzErro($erro)
	{
		if ($erro='Trying to get property of non-object')
			return 'Verifique se os dados estao preenchidos corretamente';
	}
	
	public static function LatLong($cep)
	{
		$bing_api = "AtytpGSg43JuyBSjNh1IWNyqxBvUm6NXSPz-RK9bGPh5A-UJvY0Hoemcl-1sIP6Y";
		$endereco_desejado = urlencode(utf8_encode($cep));
		$endereco_final = "http://dev.virtualearth.net/REST/v1/Locations?postalCode=".$endereco_desejado."&output=xml&key=".$bing_api."";
		$geocode=file_get_contents($endereco_final);
		$output= new \SimpleXMLElement($geocode);
		$array = ["latitude" => $output->ResourceSets->ResourceSet->Resources->Location->Point->Latitude[0] ,
				  "longitude" =>  $output->ResourceSets->ResourceSet->Resources->Location->Point->Longitude[0],];
		return $array;
	}
	
	public static function validaData($date, $format = 'Y-m-d')
	{
		$d = \DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
}
	
		


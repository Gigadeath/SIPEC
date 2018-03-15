<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\IndexController; 
use Session;

class Produto extends Model
{
    protected $fillable = array('nome','codTipoProduto');
	protected $table = 'tblproduto';
	
	
	
	public function TipoProduto() 
	{
        return $this->belongsTo('App\TipoProduto','codTipoProduto');
    }

	
	public function ProdutosNota()
	{
        return $this->hasMany('App\ProdutosNota','codProduto');
    }
	public function CotacaoProdutos()
	{
        return $this->hasMany('App\CotacaoProduto','codProduto');
    }
		
							
							
	public static function cadastroProduto($dados,$modal)
	{	\DB::beginTransaction();
		for($count =0;isset($dados['nome'][$count])==true;$count++)
		{
			if ($modal==true)
			{
				$url="$_SERVER[REQUEST_URI]";	
			}else
			{
				$url='prestacao/public/CadProduto';
			}
			
				$tipoProduto=\DB::table('tbltipoproduto')
							->select(\DB::raw('count(*) as contador'))
							->where('id','=',isset($dados['codTipoProduto'])==true ? $dados['codTipoProduto'] : null)
							->value('contador');
						
					if(strlen($dados['nome'][$count])>=2)
					{
							if($tipoProduto>0) 
							{	
								Try
								{
									// atribuindo os dados nos atributos 
									
									$produto = new Produto(); 
									$produto->nome = strtoupper ( $dados['nome'][$count] );
									$tipoProduto=TipoProduto::find($dados['codTipoProduto'][$count])->id;
									$produto->TipoProduto()->associate($tipoProduto);
									$produto-> save(); //inserindo dados na base
									
	
								}catch(\Error $e)
								{
									\DB::rollBack();
									Session::put('dados', $dados);//em caso de exce??o retorna dados
									Session::put('erro','6');// erro 
									header('HTTP/1.1 500 Internal Server Booboo');
									header('Content-Type: application/json; charset=UTF-8');
									die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
									return IndexController::Message('alert',$e->getMessage(),$url);
								}
							}else
							{
							//erro no cep
								Session::put('dados', $dados);
								Session::put('erro','3');
								header('HTTP/1.1 500 Internal Server Booboo');
								header('Content-Type: application/json; charset=UTF-8');
								die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
								return IndexController::Message('alert',' selecione um tipo de produto ',$url); 
							}
					} else
					{
					
						Session::put('dados', $dados);
						Session::put('erro','1');
						header('HTTP/1.1 500 Internal Server Booboo');
						header('Content-Type: application/json; charset=UTF-8');
						die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
						return IndexController::Message('alert','Nome invalido ',$url); 
					}
	
		}
		\DB::commit();
		return IndexController::Message('success','produto cadastrado com sucesso', $url);// mensagem ao usuario  
	}
	
		
		
		
		
	
	public static function visualizaDados($parameter,$combo)
	{
		$tipoP=\DB::table('tblproduto')
				->select(\DB::raw('*'))
				->get();
		if ($parameter=='combo')
		{
		
			$produto=\DB::table('tblproduto')
				->select(\DB::raw('*'))
				->get();
				
		$html='<option value="">Selecione...</option>';
		
		
		foreach ($produto as $produto) 
		{
			$html.='<option value="'.$produto->id.'">'.$produto->nome.'</option>';
		}
		return $html;
			
		}
		else
		{
			if($parameter=='table')
			{
				if($combo==0)
					$combo=1;
				
				$final=$combo*10;
				$inicio=$final - 9;
				
				$produtos=Produto::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				
				$html="";
				foreach ($produtos as $prod) 
				{
				
					$html.="<tr>";
					$html.="<td>".$prod->id."</td>";
					$html.="<td>".$prod->nome."</td>";
					$html.="<td>".$prod->codTipoProduto."</td>";
					$html.="<td>X</td>";
					$html.="</tr>";
				
				}
				echo $html;
				
			}
			

		}
			
			
	}
	
	public static function Page($combo)
	{
		if($combo==0)
		{
			$combo = 1;
		}
		$pagination=Produto::count();
		$pagination/=10;
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
			$html.="<li class='pagination-previous'><a href='#' onclick='loadProdutos(".$previous .")'>Anterior </a></li>";
			
			
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
			$html.="<li class='pagination-next disabled'>Proximo</li>";
			$html.="<li class='pagination-Last disabled'>Ultimo</li>";
		}
		else
		{
			$next=$combo + 1;
			$html.="<li class='pagination-next'><a href='#' onclick='loadProdutos(".$next .")'>Proximo </a></li>";
			$html.="<li class='pagination-last'><a href='#' onclick='loadProdutos(".ceil($pagination).")'>Ultimo </a></li>";
		}
		$html.=" </ul>";
		$html.=" </nav>";
		
		echo $html;
	}
}
		



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
				
	public static function cadastroProduto($dados,$id)
	{	
		\DB::beginTransaction();
		for($count =0;isset($dados['nome'][$count])==true;$count++)
		{
			$tipoProduto=\DB::table('tbltipoproduto')
				->select(\DB::raw('count(*) as contador'))
				->where('id','=',isset($dados['codTipoProduto'][$count])==true ? $dados['codTipoProduto'][$count] : null)
				->value('contador');
						
			if(strlen($dados['nome'][$count])>2)
			{
				if($tipoProduto>0) 
				{	
					Try
					{
						// atribuindo os dados nos atributos 			
						if($id > 0 )
						{
							$produto = Produto::find($id); 
						}
						else
						{
							$produto = new Produto();//instancia DRE
						}			 
						$produto->nome = strtoupper ( $dados['nome'][$count] );
						$tipoProduto=TipoProduto::find($dados['codTipoProduto'][$count])->id;
						$produto->TipoProduto()->associate($tipoProduto);
						$produto-> save(); //inserindo dados na base
						\DB::commit();
						return IndexController::Message('success','produto cadastrado com sucesso', 'prestacao/public/CadProduto');// mensagem ao usuario  
					}catch(\Error $e)
					{
						\DB::rollBack();
						Session::put('dados', $dados);//em caso de exce??o retorna dados
						Session::put('erro','6');// erro 
						return IndexController::Message('alert',$e->getMessage(), 'prestacao/public/CadProduto');
					}
				}else
				{
					//erro no cep
					Session::put('dados', $dados);
					Session::put('erro','3');
					return IndexController::Message('alert',' selecione um tipo de produto ', 'prestacao/public/CadProduto'); 
				}
			} else
			{		
				Session::put('dados', $dados);
				Session::put('erro','1');
				return IndexController::Message('alert','Nome invalido ', 'prestacao/public/CadProduto'); 
			}
	
		}
		
	}
	
	public static function alteraProduto($dados,$id)
	{	
		\DB::beginTransaction();
		for($count =0;isset($dados['nome'][$count])==true;$count++)
		{
			$tipoProduto=\DB::table('tbltipoproduto')
				->select(\DB::raw('count(*) as contador'))
				->where('id','=',isset($dados['codTipoProduto'][$count])==true ? $dados['codTipoProduto'][$count] : null)
				->value('contador');
						
				if(strlen($dados['nome'][$count])>2)
				{
					if($tipoProduto>0) 
					{	
						Try
						{
							// atribuindo os dados nos atributos 						
							$produto = Produto::find($id); 		 
							$produto->nome = strtoupper ( $dados['nome'][$count] );
							$tipoProduto=TipoProduto::find($dados['codTipoProduto'][$count])->id;
							$produto->TipoProduto()->associate($tipoProduto);
							$produto-> save(); //inserindo dados na base
							\DB::commit();
							return IndexController::Message('success','produto cadastrado com sucesso', 'prestacao/public/CadProduto');// mensagem ao usuario  
						}catch(\Error $e)
						{
							\DB::rollBack();
							Session::put('dados', $dados);//em caso de exce??o retorna dados
							Session::put('erro','6');// erro 
							return IndexController::Message('alert',$e->getMessage(), 'prestacao/public/CadProduto');
						}
					}else
					{
						//erro no cep
						Session::put('dados', $dados);
						Session::put('erro','3');
						return IndexController::Message('alert',' selecione um tipo de produto ', 'prestacao/public/CadProduto'); 
					}
				} else
				{	
					Session::put('dados', $dados);
					Session::put('erro','1');
					return IndexController::Message('alert','Nome invalido ', 'prestacao/public/CadProduto'); 
				}
		}
		
	}
	
	public static function visualizaDados($id,$parameter,$combo)
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
				if(strlen($id)<=0)
				{
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$inicio=$final - 9;
					$produto=Produto::where('id','>=',$inicio)->where('id','<=',$final)->limit(10)->get();
				}
				else
				{
					if($combo==0)
						$combo=1;
					
					$final=$combo*10;
					$offset=($combo-1)*10;
					$inicio=$final - 9;
					$produto=Produto::where('nome','like','%'.$id.'%')->orWhere('codTipoProduto','like','%'.$id.'%')->orWhere('id','like','%'.$id.'%')->limit(10)->offset($offset)->get();
					
				}
				$html="";
				foreach ($produto as $prod) 
				{
					$html.="<tr>";
					$html.="<td>".$prod->id."</td>";
					$html.="<td>".$prod->nome."</td>";
					if($prod->codTipoProduto == 1)
					{
						$html.="<td>"."Normal"."</td>";
					}else if($prod->codTipoProduto == 2)
					{
						$html.="<td>"."Restrito"."</td>";
					}
					$html.="<td><i class='fas fa-edit' style='cursor: pointer;' onfocus = ' javascript: setMainCursor ('hand' )' onclick='edit(".$prod->id.")'></i></td>";
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
						$html.="<li class='pagination-next disabled'>Próximo</li>";
						$html.="<li class='pagination-Last disabled'>Ultimo</li>";
					}
					else
					{
						$next=$combo + 1;
						$html.="<li class='pagination-next'><a href='#' onclick='loadProdutos(".$next .")'>Próximo</a></li>";
						$html.="<li class='pagination-last'><a href='#' onclick='loadProdutos(".ceil($pagination).")'>Ultimo</a></li>";
					}
					$html.=" </ul>";
					$html.=" </nav>";
					echo $html;
				}
				else
				{
					if($parameter=='update')
					{		
						$tipoproduto=\DB::table('tbltipoproduto')
						->select(\DB::raw('*'))
						->get();
						$count=Produto::where('id',$id)->count();
							if($count>0)
							{
								$dados=Produto::select('nome','codTipoProduto')->where('id','=',$id)->first();
								$html="<div class='columns large-4'>";        
								$html.="<label>Nome:";
								$html.="<input type='text' name='nome[]' placeholder='Insira o nome 'value='".$dados->nome."'>";
								$html.="</label><br>";
								$html.="</div>";
								$html.="<div class='columns large-4'>";
								$html.="<label>Tipo:";
								$html.="<select id='selectTipo' name=codTipoProduto[]' required>";
								$html.='<option value="">Selecione...</option>';
								foreach ($tipoproduto as $tipoproduto) 
								{
								$html.='<option value="'.$tipoproduto->id.'">'.$tipoproduto->tipo.'</option>';
								}
								$html.="</select>"; 
								$html.="</label><br>";
								$html.="</div>";
								Session::put('Produto',$id);
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
		


<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutosNota extends Model
{
    protected $fillable = array('codNota','codProduto','codMedida','qtde','valorUnit');
	protected $table = 'tblprodutosnota';
	
	public function Produto() 
	{
        return $this->belongsTo('App\Produto','codProduto');
    }
	
	public function NotaFiscal() 
	{
        return $this->belongsTo('App\NotaFiscal','codNota');
    }
	public function Medida() 
	{
        return $this->belongsTo('App\Medida','codMedida');
    }
	
	public static function cadastraProdutosNota($dados,$id)
	{	\DB::beginTransaction();
		for($count =0;isset($dados['produto'][$count])==true;$count++)
		{
				$produto = Produto::where('id',$dados['produto'][$count])->count();
				$medida=Medida::where('id',$dados['codMedida'][$count])->count();
					if($produto > 0)
					{
							if($medida >0) 
							{	
								Try
								{
									// atribuindo os dados nos atributos 
									
									$produtosnota = new ProdutosNota(); 
									$produtosnota->codNota = $id;
									$codProduto = Produto::find($dados['produto'][$count])->id;
									$produtosnota->Produto()->associate($codProduto);
									$codMedida=Medida::find($dados['produto'][$count])->id;
									$produtosnota->Medida()->associate($codMedida);
									$produtosnota->qtde = $dados['qtde'][$count];
									$produtosnota->valorUnit= $dados['valorunit'][$count];
									$produtosnota->save();
									
								}catch(\Error $e)
								{
									\DB::rollBack();
									return false;
								}
								
								catch(Throwable $e) 
								{
									\DB::rollBack();
									return false;
								}
							}else
							{
								\DB::rollBack();
								return false;
							}
					} else
					{
					
						\DB::rollBack();
						return false;
					}
	
		}
		\DB::commit();
		return true;
	}
}

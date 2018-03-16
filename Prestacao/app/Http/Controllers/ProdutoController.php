<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Produto;
class ProdutoController extends Controller
{
    //
	 
    public function index()
    {
        
    }
   
    public static function create()//cadastro do Produto
    {
		
       return Produto::cadastroProduto($_POST,true); //envia Post para a classe produto no metodo cadastroProduto
    }
    
    public static function store()
    {
        return Produto::cadastroProduto($_POST,true);
    }
    
	 public static function show($id,$parameter,$combo)
    {
       if ($parameter=='combo')
	   {
		   return Produto::visualizaDados($id,$parameter,$combo);
	   }
	   else
	   {
			
			if ($parameter=='table')
			{
				return Produto::visualizaDados($id,$parameter,$combo);
			}
			else
			{
				if($parameter=='page')
				{
					return Produto::Page($id,$combo);
				}
			}
	   }
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update($id)
    {
        //
    }
   
    public function destroy($id)
    {
        //
    }
}
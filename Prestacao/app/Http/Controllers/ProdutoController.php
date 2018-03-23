<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\Session;

class ProdutoController extends Controller
{
    //
	 
    public function index()
    {
        
    }
   
    public static function create(Request $request)//cadastro do Produto
    {
		
      if ($request->ajax())
		{
			return Produto::cadastroProduto($request->all(),null); 
		}
    }
    
    public static function store()
    {
        
    }
    
	 public static function show(Request $request,$id,$parameter,$combo)
    {
		if ($request->ajax())
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
							return Produto::visualizaDados($id,$parameter,$combo);
						}
						else
						{
							if($parameter=='update')
							{
								return Produto::visualizaDados($id,$parameter,$combo);
							}
						}
					}
			}
		}
	}
    
    public function edit($id)
    {
        //
    }
    
    public static function update(Request $request,$id)
    {
		if ($request->ajax())
		{
			Session::forget('Produto');
			return Produto::cadastroProduto($request->all(),$id);
		}
    }
   
    public function destroy($id)
    {
        //
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use Session;

class FornecedorController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create(Request $request)
    {
		return Fornecedor::cadastraFornecedor($request->all(),null);
    }

    
    public function store()
    {
        //
    }

    
    public static function show(Request $request,$id,$parameter,$combo)
    {	
	
       if ($parameter=='combo')
	   {
		   return Fornecedor::visualizaDados($id,$parameter,$combo);
	   }
	   else
		{
			if ($parameter=='table')
			{
				return Fornecedor::visualizaDados($id,$parameter,$combo);
			}
			else
			{
				if($parameter=='page')
				{
					return Fornecedor::visualizaDados($id,$parameter,$combo);
				}
				else
				{
					if($parameter=='update')
					{
						return Fornecedor::visualizaDados($id,$parameter,$combo);
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
        Session::forget('Fornecedor');
		return Fornecedor::cadastraFornecedor($request->all(),$id);
    }

   
    public function destroy($id)
    {
        //
    }
}


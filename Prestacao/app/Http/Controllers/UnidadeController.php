<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validacao;
use App\Unidade;
use Validator;
use Session;


class UnidadeController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create(Request $request)
    {
       		return Unidade::cadastraUnidade($request->all(),null);
    }

    
    public function store()
    {
        //
    }

     public static function show(Request $request,$id,$parameter,$combo)
    {
		if ($request->ajax())
		{
			if ($parameter=='combo')
			{
				return Unidade::visualizaDados($id,$parameter,$combo);
			}
			else
			{
					if ($parameter=='table')
					{
						return Unidade::visualizaDados($id,$parameter,$combo);
					}
					else
					{
						if($parameter=='page')
						{
							return Unidade::visualizaDados($id,$parameter,$combo);
						}
						else
						{
							if($parameter=='update')
							{
								return Unidade::visualizaDados($id,$parameter,$combo);
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
			Session::forget('Unidade');
			return Unidade::cadastraUnidade($request->all(),$id);
		}
    }

   
    public function destroy($id)
    {
        //
    }
}

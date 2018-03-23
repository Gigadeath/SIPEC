<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Funcionario; 
use Illuminate\Support\Facades\Session;

class FuncionarioController extends Controller
{
    public function index()
    {
        
    }
	
    public static function create(Request $request)
    {
		if ($request->ajax())
		{
			return Funcionario::cadastroFuncionario($request->all(),null); 
		}
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
				return Funcionario::visualizaDados($id,$parameter,$combo);
			}
			else
			{
					if ($parameter=='table')
					{
						return Funcionario::visualizaDados($id,$parameter,$combo);
					}
					else
					{
						if($parameter=='page')
						{
							return Funcionario::visualizaDados($id,$parameter,$combo);
						}
						else
						{
							if($parameter=='update')
							{
								return Funcionario::visualizaDados($id,$parameter,$combo);
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
			Session::forget('Funcionario');
			return Funcionario::cadastroFuncionario($request->all(),$id);
		}
    }

   
    public function destroy($id)
    {
       
    }
}

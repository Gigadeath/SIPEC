<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Funcionario; 

class FuncionarioController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create()
    {
       return Funcionario::cadastroFuncionario($_POST); 
    }

    
    public function store()
    {
        //
    }

    
    public static function show($id,$parameter,$combo)
    {
       if ($parameter=='combo')
	   {
		   return Funcionario::visualizaDados($parameter,$combo);
	   }
	   else
	   {
			if ($parameter=='table')
			{
				return Funcionario::visualizaDados($parameter,$combo);
			}
			else
			{
				if($parameter=='page')
				{
					return Funcionario::Page($combo);
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

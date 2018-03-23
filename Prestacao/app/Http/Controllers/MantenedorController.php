<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validacao;
use App\Mantenedor;
use Validator;
use Session;

class MantenedorController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create(Request $request)
    {
		// chama para cadastro
		return Mantenedor::cadastraMantenedor($request->all(),null);
    }

    
    public static function store()
    {
           

        //Mantenedor::cadastraMantenedor($_POST);



        //return back()->with('success', 'User created successfully.');
    }
	   
    public static function show(Request $request,$id,$parameter,$combo)// função em beta para visualizador de dados universal controlado pela indexController
    {
        if ($parameter=='combo')//verifica qual parametro de retorno
		{
			return Mantenedor::visualizaDados($id,$parameter,$combo);// retorna a função especifica de visualização
		}
		else
		{
			if ($parameter=='table')
			{
				return Mantenedor::visualizaDados($id,$parameter,$combo);
			}
			else
			{
				if($parameter=='page')
				{
					return Mantenedor::visualizaDados($id,$parameter,$combo);
				}
				else
				{
					if($parameter=='update')
					{
						return Mantenedor::visualizaDados($id,$parameter,$combo);
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
        Session::forget('Mantenedor');
		return Mantenedor::cadastraMantenedor($request->all(),$id);
    }

   
    public function destroy($id)
    {
        //
    }
}

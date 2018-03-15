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

   
    public static function create()
    {
		// chama para cadastro
		return Mantenedor::cadastraMantenedor($_POST);
    }

    
    public static function store()
    {
           

        //Mantenedor::cadastraMantenedor($_POST);



        //return back()->with('success', 'User created successfully.');
    }
	   
    public static function show($id,$parameter,$combo)// função em beta para visualizador de dados universal controlado pela indexController
    {
        if ($parameter=='combo')//verifica qual parametro de retorno
		{
			return Mantenedor::visualizaDados($combo);// retorna a função especifica de visualização
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medida;


class MedidaController extends Controller
{
     //
	 
    public function index()
    {
        
    }

   
    public static function create()
    {
       return Medida::cadastroMedida($_POST);  
    }

    
    public function store()
    {
        //
    }

    
    public static function show($id,$parameter)
    {
        if ($parameter=='combo')
		{
			return Medida::visualizaDados();
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

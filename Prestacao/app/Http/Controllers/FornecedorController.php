<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create()
    {
		return Fornecedor::cadastraFornecedor($_POST);
    }

    
    public function store()
    {
        //
    }

    
    public static function show($parameter,$combo)
    {
        if ($combo=='combo')
	   {
		   return Fornecedor::visualizaDados($combo);
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

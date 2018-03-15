<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoProduto;

class TipoProdutoController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create()
    {
       return TipoProduto::cadastroTipoProduto($_POST);  
    }

    
    public function store()
    {
        //
    }

    
    public static function show($id,$parameter)
    {
		
        if ($parameter=='combo')
		{
			return TipoProduto::visualizaDados();
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

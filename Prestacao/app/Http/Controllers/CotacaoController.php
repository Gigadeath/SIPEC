<?php

namespace App\Http\Controllers;
use App\Cotacao;
use App\CotacaoProduto;
use Illuminate\Http\Request;

class CotacaoController extends Controller
{
     
    public function index()
    {
        
    }

   
    public static function create()
    {
      Cotacao::cadastroCotacao($_POST); 
	  print_r($_POST);
    }

    
    public function store()
    {
        //
    }

    
    public function show($id)
    {
        //
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
?>
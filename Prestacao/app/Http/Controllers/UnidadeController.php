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

   
    public static function create()
    {
       		return Unidade::cadastraUnidade($_POST);
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

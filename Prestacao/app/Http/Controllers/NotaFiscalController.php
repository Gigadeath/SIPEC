<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotaFiscal;

class NotaFiscalController extends Controller
{
    //
	 
    public static  function index()
    {
        
    }

   
    public static function create($id)
    {
		return NotaFiscal::cadastraNota($_POST,$id);
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

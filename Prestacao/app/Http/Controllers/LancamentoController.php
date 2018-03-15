<?php

namespace App\Http\Controllers;
use Session;
use App\Lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    //
	 
    public static function index()
    {
		Session::put('codUnid', '1');
		return Lancamento::ConsultaLancamentos();
    }

   
    public function create()
    {
       
    }

    
    public function store()
    {
        //
    }

    
    public static function show($id)
    {
		
        return Lancamento::consultaDetalhada($id);
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

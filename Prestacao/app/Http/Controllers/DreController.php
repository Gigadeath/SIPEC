<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dre;

class DreController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create()
    {
       return Dre::cadastroDre($_POST); 
    }

    
    public function store()
    {
        //
    }

    
    public static function show($id,$parameter,$combo)
    {
        if ($parameter=='combo')
	   {
		   return Dre::visualizaDados($combo);
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

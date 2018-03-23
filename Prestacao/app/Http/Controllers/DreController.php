<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dre;
use Illuminate\Support\Facades\Session;

class DreController extends Controller
{
    //
	 
    public function index()
    {
        
    }

   
    public static function create(Request $request)
    {
		if ($request->ajax())
		{
			return Dre::cadastroDre($request->all(),null); 
		}
    }

    
    public function store()
    {
        //
    }
	
    
    public static function show(Request $request,$id,$parameter,$combo)
    {
		if ($request->ajax())
		{
			if ($parameter=='combo')
			{
				return Dre::visualizaDados($id,$parameter,$combo);
			}
			else
			{
				if ($parameter=='table')
				{
					return Dre::visualizaDados($id,$parameter,$combo);
				}
				else
				{
					if($parameter=='page')
					{
						return Dre::visualizaDados($id,$parameter,$combo);
					}
					else
					{
						if($parameter=='update')
						{
							return Dre::visualizaDados($id,$parameter,$combo);
						}
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
		if ($request->ajax())
		{
			Session::forget('Dre');
			return Dre::cadastroDre($request->all(),$id);
		}
    }

   
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Lancamento;

class IndexController extends Controller
{
	public static  function index($id) // retorna a principal
    {
		Session::put('id', $id);

        return view('index');
    }
	public static function getFooter()// retorna o rodapé
	{
		return view('footer');
	}
	public static function getMenu()// retorna um item do menu
	{
		//verifica a URL do Server
		$actual_link = "$_SERVER[REQUEST_URI]";
		//da Parse no link
		$sub_link=substr($actual_link,18);
		if (Session::has('id')==true && Session::get('id') >0)
		{
			$sub_link = str_replace("/".Session::get('id'),"",$sub_link);

			switch($sub_link)
			{
				case "ConLancamento":
					return view('menu')->with('active','15');
				break;
				
				case "CadNota":
					return view('menu')->with('active','15');
				break;
			}
		}
		else
		{
		
		switch($sub_link)//verfica qual menu o usuário está e retorna qual item qual item deverá ficar colorido
		{
			case "sipec":
				return view('menu')->with('active','1');
				break;
			case "CadFuncionario":
				return view('menu')->with('active','2');
				break;
			case "CadMantenedora":
				return view('menu')->with('active','3');
				break;
			case "CadDre":
				return view('menu')->with('active','4');
				break;
			case "CadUnidade":
				return view('menu')->with('active','5');
				break;
			case "CadLancamento":
				return view('menu')->with('active','6');
				break;
			case "CadFornecedor":
				return view('menu')->with('active','7');
				break;
			case "CadProduto":
				return view('menu')->with('active','8');
				break;
			case "CadCotacao":
				return view('menu')->with('active','9');
				break;
			case "CadNota":
				return view('menu')->with('active','10');
				break;
			case "ConFuncionario":
				return view('menu')->with('active','11');
				break;
			case "ConMantenedora":
				return view('menu')->with('active','12');
				break;
			case "ConDre":
				return view('menu')->with('active','13');
				break;
			case "ConUnidade":
				return view('menu')->with('active','14');
				break;
			case "ConLancamento":
				return view('menu')->with('active','15');
				break;
			case "ConFornecedor":
				return view('menu')->with('active','16');
				break;
			case "ConProduto":
				return view('menu')->with('active','17');
				break;
			case "ConCotacao":
				return view('menu')->with('active','18');
				break;
			case "ConNota":
				return view('menu')->with('active','19');
				break;
			case "RelatorioAliRe":
				return view('menu')->with('active','20');
				break;
			case "RelatorioJustificativa":
				return view('menu')->with('active','21');
				break;
			case "RelatorioLancamento":
				return view('menu')->with('active','22');
				break;
			default:
				return "404 NOT FOUND" ;
				break;
		}
	}
		
}
   public static function getContent()//retorna o conteudo da pagina
    {
		//pega a url
        $actual_link = "$_SERVER[REQUEST_URI]";
		//quebra o link
		$sub_link=substr($actual_link,18);
		
		if (Session::has('id')==true && Session::get('id') >0)
		{
			$sub_link = str_replace("/".Session::get('id'),"",$sub_link);
			switch($sub_link)
			{
				case "ConLancamento":
					return view('consultaLancamentos');
				break;
				
				case "CadNota":
					return view('cadastroNotaFiscal');
				break;
				
				
			}
			
			
			
			
		}
		else
		{
		
			//verifica a qual pagina o link pertence
			switch($sub_link)
			{
				case "login":
					return view('login');
					break;
				case "sipec":
					return view('content');
					break;
				case "CadFuncionario":
					return view('CadastroFuncionario');
					break;
				case "CadMantenedora":
					return view('CadastroMantenedor');
					break;
				case "CadDre":
					return view('CadastroDRE');
					break;
				case "CadUnidade":
					return view('CadastroUnidades');
					break;
				case "CadLancamento":
					return view('CadastroLancamentos');
					break;
				case "CadFornecedor":
					return view('CadastroFornecedor');
					break;
				case "CadProduto":
					return view('CadastroProduto');
					break;
				case "CadCotacao":
					return view('cadastroCotacao');
					break;
				case "CadNota":
					return view('CadastroNotaFiscal');
					break;
				case "ConFuncionario":
					return view('consultaFuncionario');
					break;
				case "ConMantenedora":
					return view('consultaMantenedor');
					break;
				case "ConDre":
					return view('consultaDRE');
					break;
				case "ConUnidade":
					return view('consultaUnidades');
					break;
				case "ConLancamento":
					return view('selecionaLancamento');
					break;
				case "ConFornecedor":
					return view('consultaFornecedor');
					break;
				case "ConProduto":
					return view('consultaProduto');
					break;
				case "ConCotacao":
					return view('consultaCotacao');
					break;
				case "ConNota":
					return view('consultaNotaFiscal');
					break;
				case "RelatorioAliRe":
					return view('RelatorioAlimRestritos');
					break;
				case "RelatorioJustificativa":
					return view('RelatorioJustificativa');
					break;
				case "RelatorioLancamento":
					return view('RelatorioLancamento');
					break;
				default:
					return "404 NOT FOUND";
					break;
			}
		
		
		}
	}
	
	public static function Message($type,$message,$url)//usado para enviar o erro padrão para qualquer página desta aplicação
    {
		//lança o tipo de erro e a mensagem
		Session::put($type, $message);
		//redireciona a url
        echo redirect($url);
    }
	
	
}

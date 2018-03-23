<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MantenedorController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\DreController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\TipoProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\NotaFiscalController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/

Route::get('/', function () {
    //return 'Hello World';
	 return view('inicial');
});
			  
Route::get('prestacao/public/login', function () {
   return IndexController::index(null);
});

Route::get('prestacao/public/sipec', function () {
    return IndexController::index(null);
});

Route::get('prestacao/public/CadFuncionario', function () {
	return IndexController::index(null);
});


Route::get('prestacao/public/CadMantenedora', function () {
	return IndexController::index(null);
});


Route::get('prestacao/public/CadDre', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/CadUnidade', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/CadLancamento', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/CadFornecedor', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/CadProduto', function () {
	return IndexController::index(null);
});




Route::get('prestacao/public/CadCotacao', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/CadNota', function () {
	return IndexController::index(null);
});


Route::get('prestacao/public/ConFuncionario', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/ConFuncionario/table', function (Request $request) {
	return FuncionarioController::show($request,$_GET['search'],'table',	$_GET['pagination']);

});

Route::get('prestacao/public/ConFuncionario/combo', function (Request $request) {

	return FuncionarioController::show($request,$_GET['search'],'combo',$_GET['pagination']);
});

Route::get('prestacao/public/ConFuncionario/page', function (Request $request) {

	return FuncionarioController::show($request,$request->search,'page',$request->pagination);
});

Route::get('prestacao/public/ConFuncionario/update', function (Request $request) {
	return FuncionarioController::show($request,$_GET['id'],'update',null);
});


Route::get('prestacao/public/ConMantenedora', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/ConMantenedora/combo', function (Request $request) {
	return MantenedorController::show($request,$_GET['search'],'combo',$_GET['pagination']);
});
Route::get('prestacao/public/ConMantenedora/table', function (Request $request) {
	return MantenedorController::show($request,$_GET['search'],'table',$_GET['pagination']);
});

Route::get('prestacao/public/ConMantenedora/page', function (Request $request) {
	return MantenedorController::show($request,$_GET['search'],'page',$_GET['pagination']);
});

Route::get('prestacao/public/ConMantenedora/update', function (Request $request) {
	return MantenedorController::show($request,$_GET['id'],'update',null);
});

Route::get('prestacao/public/ConDre', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConDre/table', function (Request $request) {
	return DreController::show($request,$_GET['search'],'table',	$_GET['pagination']);
});
Route::get('prestacao/public/ConDre/page', function (Request $request) {
	return DreController::show($request,$_GET['search'],'page',	$_GET['pagination']);
});

Route::get('prestacao/public/ConDre/combo', function (Request $request) {
	return DreController::show($request,$_GET['search'],'combo',$_GET['pagination']);
});

Route::get('prestacao/public/ConDre/update', function (Request $request) {
	return DreController::show($request,$_GET['id'],'update',null);
});
Route::get('prestacao/public/ConUnidade', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConUnidade/table', function (Request $request) {
	return UnidadeController::show($request,$_GET['search'],'table',	$_GET['pagination']);

});

Route::get('prestacao/public/ConUnidade/combo', function (Request $request) {
	return UnidadeController::show($request,$_GET['search'],'combo',$_GET['pagination']);
});

Route::get('prestacao/public/ConUnidade/page', function (Request $request) {
	return UnidadeController::show($request,$request->search,'page',$request->pagination);
});

Route::get('prestacao/public/ConUnidade/update', function (Request $request) {
	return UnidadeController::show($request,$_GET['id'],'update',null);
});
Route::get('prestacao/public/ConLancamento', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConFornecedor', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/ConFornecedor/table', function (Request $request) {
	return FornecedorController::show($request,$_GET['search'],'table',	$_GET['pagination']);
});
Route::get('prestacao/public/ConFornecedor/page', function (Request $request) {
	return FornecedorController::show($request,$_GET['search'],'page',	$_GET['pagination']);
});

Route::get('prestacao/public/ConFornecedor/combo', function (Request $request) {
	return FornecedorController::show($request,$_GET['search'],'combo',$_GET['pagination']);
});

Route::get('prestacao/public/ConFornecedor/update', function (Request $request) {
	return FornecedorController::show($request,$_GET['id'],'update',null);
});

Route::get('prestacao/public/ConProduto/table', function (Request $request) {
	return ProdutoController::show($request,$_GET['search'],'table',	$_GET['pagination']);

});
Route::get('prestacao/public/ConProduto/combo', function (Request $request) {
	return ProdutoController::show($request,$_GET['search'],'combo',$_GET['pagination']);

});

Route::get('prestacao/public/ConProduto/page', function (Request $request) {
	return ProdutoController::show($request,$_GET['search'],'page',	$_GET['pagination']);
});

Route::get('prestacao/public/ConProduto/update', function (Request $request) {
	return ProdutoController::show($request,$_GET['id'],'update',null);
});



Route::get('prestacao/public/ConMedida/combo', function () {
	return  MedidaController::show(null,'combo');
});


Route::get('prestacao/public/ConCotacao', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/ConNota', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/RelatorioAliRe', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/RelatorioJustificativa', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/RelatorioLancamento',function () {
	return IndexController::index(null);
});

Route::post('prestacao/public/CadMantenedora/create', function (Request $request) {
	 return MantenedorController::create($request);
});


Route::post('prestacao/public/CadMantenedora/update', function (Request $request) {
	 return MantenedorController::update($request,Session::get('Mantenedor'));
});


Route::post('prestacao/public/CadFornecedor/create', function (Request $request) {
	 return FornecedorController::create($request);
});

Route::post('prestacao/public/CadFornecedor/update', function (Request $request) {
	 return FornecedorController::update($request,Session::get('Fornecedor'));
});

Route::post('prestacao/public/CadDre/create', function (Request $request) {
	 return DreController::create($request);
});

Route::post('prestacao/public/CadDre/update', function (Request $request) {
	 return DreController::update($request,Session::get('Dre'));
});


Route::post('prestacao/public/CadFuncionario/create', function (Request $request) {
	 return FuncionarioController::create($request);
});

Route::post('prestacao/public/CadFuncionario/update', function (Request $request) {
	 return FuncionarioController::update($request,Session::get('Funcionario'));
});

Route::post('prestacao/public/CadProduto/create', function (Request $request) {
	 return ProdutoController::create($request);
});

Route::post('prestacao/public/CadProduto/update', function (Request $request) {
	 return ProdutoController::update($request,Session::get('Produto'));
});



Route::post('prestacao/public/CadUnidade/create', function (Request $request) {
	 return UnidadeController::create($request);
});

Route::post('prestacao/public/CadUnidade/update', function (Request $request) {
	 return UnidadeController::update($request,Session::get('Produto'));
});

Route::post('prestacao/public/CadCotacao/create', function () {
	 return CotacaoController::create();
});

Route::get('prestacao/public/ConLancamento/{id}',  function ($id) {
	return IndexController::index($id);
})->where(['id' => '[0-9]+']);

Route::get('prestacao/public/CadNota/{id}',  function ($id) {
	return IndexController::index($id);
})->where(['id' => '[0-9]+']);

Route::post('prestacao/public/CadNota/create',  function () {
	return NotaFiscalController::create(Session::get('id'));
})->where(['id' => '[0-9]+']);





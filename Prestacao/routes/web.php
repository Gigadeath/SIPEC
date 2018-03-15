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

Route::get('prestacao/public/ConFuncionario/table', function () {
	return FuncionarioController::show(null,'table',	$_GET['pagination']);

});

Route::get('prestacao/public/ConFuncionario/page', function () {
	return FuncionarioController::show(null,'page',	$_GET['pagination']);
});


Route::get('prestacao/public/ConMantenedora', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConDre', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConUnidade', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConLancamento', function () {
	return IndexController::index(null);
});
Route::get('prestacao/public/ConFornecedor', function () {
	return IndexController::index(null);
});


Route::get('prestacao/public/ConProduto', function () {
	return IndexController::index(null);
});

Route::get('prestacao/public/ConProduto/table', function () {
	return ProdutoController::show(null,'table',	$_GET['pagination']);

});

Route::get('prestacao/public/ConProduto/page', function () {
	return ProdutoController::show(null,'page',	$_GET['pagination']);
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

Route::post('prestacao/public/CadMantenedora/create', function () {
	 return MantenedorController::create();
});

Route::post('prestacao/public/CadFornecedor/create', function () {
	 return FornecedorController::create();
});
Route::post('prestacao/public/CadDre/create', function () {
	 return DreController::create();
});
Route::post('prestacao/public/CadFuncionario/create', function () {
	 return FuncionarioController::create();
});
Route::post('prestacao/public/CadProduto/create', function () {
	 return ProdutoController::create();
});

Route::post('prestacao/public/CadUnidade/create', function () {
	 return UnidadeController::create();
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





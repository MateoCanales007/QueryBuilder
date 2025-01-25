<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/pedidos-usuario-2', [TestController::class, 'pedidosUsuario2']);
Route::get('/test/pedidos-con-usuarios', [TestController::class, 'pedidosConUsuarios']);
Route::get('/test/pedidos-en-rango', [TestController::class, 'pedidosEnRango']);
Route::get('/test/usuarios-con-r', [TestController::class, 'usuariosConR']);
Route::get('/test/total-pedidos-usuario-5', [TestController::class, 'totalPedidosUsuario5']);
Route::get('/test/pedidos-ordenados-por-total', [TestController::class, 'pedidosOrdenadosPorTotal']);
Route::get('/test/suma-total-pedidos', [TestController::class, 'sumaTotalPedidos']);
Route::get('/test/pedido-mas-economico', [TestController::class, 'pedidoMasEconomico']);
Route::get('/test/pedidos-agrupados-por-usuario', [TestController::class, 'pedidosAgrupadosPorUsuario']);

Route::get('/test/debug', [TestController::class, 'debug']);
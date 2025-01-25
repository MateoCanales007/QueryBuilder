<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/usuarios-con-pedidos', [TestController::class, 'testUsuariosConPedidos']);
Route::get('/test/pedidos-de-usuario/{userId}', [TestController::class, 'testPedidosDeUsuario']);
Route::get('/test/total-pedidos-por-usuario', [TestController::class, 'testTotalPedidosPorUsuario']);

Route::get('/test/verificar-datos', [TestController::class, 'verificarDatos']);

Route::get('/test/pedidos-de-usuario/{id}', [TestController::class, 'pedidosDeUsuario']);
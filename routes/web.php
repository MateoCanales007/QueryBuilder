<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('test')->group(function () {
    Route::get('/pedidos-usuario/{id}', [TestController::class, 'pedidosUsuario'])->name('test.pedidos-usuario');
    Route::get('/pedidos-con-usuarios', [TestController::class, 'pedidosConUsuarios'])->name('test.pedidos-con-usuarios');
    Route::get('/pedidos-en-rango/{min}/{max}', [TestController::class, 'pedidosEnRango'])->name('test.pedidos-en-rango');
    Route::get('/usuarios-con-letra/{letra}', [TestController::class, 'usuariosConLetra'])->name('test.usuarios-con-letra');
    Route::get('/total-pedidos-usuario/{id}', [TestController::class, 'totalPedidosUsuario'])->name('test.total-pedidos-usuario');
    Route::get('/pedidos-ordenados-por-total', [TestController::class, 'pedidosOrdenadosPorTotal'])->name('test.pedidos-ordenados-por-total');
    Route::get('/suma-total-pedidos', [TestController::class, 'sumaTotalPedidos'])->name('test.suma-total-pedidos');
    Route::get('/pedido-mas-economico', [TestController::class, 'pedidoMasEconomico'])->name('test.pedido-mas-economico');
    Route::get('/pedidos-agrupados-por-usuario', [TestController::class, 'pedidosAgrupadosPorUsuario'])->name('test.pedidos-agrupados-por-usuario');
});
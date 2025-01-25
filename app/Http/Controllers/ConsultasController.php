<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    // Ejemplo de consultas
    
    // 1. Obtener todos los usuarios con sus pedidos
    public function testUsuariosConPedidos()
    {
        return Usuario::with('pedidos')->get();
    }

    // 2. Obtener pedidos de un usuario específico
    public function testPedidosDeUsuario($userId)
    {
        return Pedido::where('id_usuario', $userId)->get();
    }

    // 3. Obtener el total de pedidos por usuario
    public function testTotalPedidosPorUsuario()
    {
        return DB::table('usuarios')
            ->leftJoin('pedidos', 'usuarios.id', '=', 'pedidos.id_usuario')
            ->select('usuarios.nombre', DB::raw('COUNT(pedidos.id) as total_pedidos'))
            ->groupBy('usuarios.id', 'usuarios.nombre')
            ->get();
    }
}
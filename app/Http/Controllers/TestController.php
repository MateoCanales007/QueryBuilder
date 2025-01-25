<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function testUsuariosConPedidos()
    {
        $usuarios = Usuario::with('pedidos')->get();
        // esto lo que hace es traer todos los usuarios con sus pedidos asociados
        return response()->json($usuarios);
    }

    public function testPedidosDeUsuario($userId)
    {
        $pedidos = Pedido::where('id_usuario', $userId)->get();
        // esto lo que hace es traer todos los pedidos de un usuario específico
        return response()->json($pedidos);
    }

    public function testTotalPedidosPorUsuario()
    {
        $totalPedidos = DB::table('usuarios')
            // esto es para hacer un join entre la tabla usuarios y pedidos
            ->leftJoin('pedidos', 'usuarios.id', '=', 'pedidos.id_usuario')
            // el select es para traer el nombre del usuario y el total de pedidos
            ->select('usuarios.nombre', DB::raw('COUNT(pedidos.id) as total_pedidos'))
            // agrupamos por el id del usuario y el nombre
            ->groupBy('usuarios.id', 'usuarios.nombre')
            // obtenemos los resultados
            ->get();
        // esto lo que hace es traer el total de pedidos por usuario
        return response()->json($totalPedidos);
    }

    public function verificarDatos()
    {
        $usuarios = Usuario::all();
        $pedidos = Pedido::all();
        return response()->json([
            'usuarios' => $usuarios,
            'pedidos' => $pedidos
        ]);
    }

    public function pedidosDeUsuario($id)
    {
        $pedidos = Pedido::where('id_usuario', $id)->get();
        if ($pedidos->isEmpty()) {
            return response()->json(['mensaje' => "No se encontraron pedidos para el usuario $id"], 404);
        }
        return response()->json($pedidos);
    }

    public function estructuraTabla()
    {
        $estructura = DB::getSchemaBuilder()->getColumnListing('pedidos');
        return response()->json($estructura);
    }
}

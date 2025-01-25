<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Recupera todos los pedidos asociados a un usuario específico.
     *
     * @param int $id ID del usuario
     */
    public function pedidosUsuario($id)
    {
        $pedidos = Pedido::where('id_usuario', $id)->get();
        return response()->json($pedidos);
    }

    /**
     * Obtiene la información detallada de los pedidos, incluyendo el nombre y correo electrónico de los usuarios.
     */
    public function pedidosConUsuarios()
    {
        $pedidos = Pedido::with('usuario:id,nombre,correo')->paginate(15);
        return response()->json($pedidos);
    }

    /**
     * Recupera todos los pedidos cuyo total esté en un rango específico.
     *
     * @param float $min Valor mínimo del rango
     * @param float $max Valor máximo del rango
     */
    public function pedidosEnRango($min, $max)
    {
        $pedidos = Pedido::whereBetween('total', [$min, $max])->get();
        return response()->json($pedidos);
    }

    /**
     * Encuentra todos los usuarios cuyos nombres comiencen con una letra específica.
     *
     * @param string $letra Letra inicial del nombre
     */
    public function usuariosConLetra($letra)
    {
        $usuarios = Usuario::where('nombre', 'like', $letra . '%')->get();
        return response()->json($usuarios);
    }

    /**
     * Calcula el total de registros en la tabla de pedidos para un usuario específico.
     *
     * @param int $id ID del usuario
     */
    public function totalPedidosUsuario($id)
    {
        $total = Pedido::where('id_usuario', $id)->count();
        return response()->json(['total_pedidos' => $total]);
    }

    /**
     * Recupera todos los pedidos junto con la información de los usuarios, 
     * ordenándolos de forma descendente según el total del pedido.
     */
    public function pedidosOrdenadosPorTotal()
    {
        $pedidos = Pedido::with('usuario')->orderBy('total', 'desc')->paginate(15);
        return response()->json($pedidos);
    }

    /**
     * Obtiene la suma total del campo "total" en la tabla de pedidos.
     */
    public function sumaTotalPedidos()
    {
        $suma = Pedido::sum('total');
        return response()->json(['suma_total' => $suma]);
    }

    /**
     * Encuentra el pedido más económico, junto con el nombre del usuario asociado.
     */
    public function pedidoMasEconomico()
    {
        $pedido = Pedido::with('usuario:id,nombre')->orderBy('total', 'asc')->first();
        return response()->json($pedido);
    }

    /**
     * Obtiene el producto, la cantidad y el total de cada pedido, agrupándolos por usuario.
     */
    public function pedidosAgrupadosPorUsuario()
    {
        $usuarios = Usuario::with(['pedidos:id,producto,cantidad,total,id_usuario'])
            ->withCount('pedidos')
            ->get()
            ->map(function ($usuario) {
                return [
                    'usuario' => $usuario->nombre,
                    'total_pedidos' => $usuario->pedidos_count,
                    'pedidos' => $usuario->pedidos
                ];
            });
        return response()->json($usuarios);
    }
}
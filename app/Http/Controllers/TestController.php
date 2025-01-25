<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    // 2. Recupera todos los pedidos asociados al usuario con ID 2.
    public function pedidosUsuario2()
    {
        $pedidos = Pedido::where('id_usuario', 2)->get();
        return response()->json($pedidos);
    }

    // 3. Obtén la información detallada de los pedidos, incluyendo el nombre y correo electrónico de los usuarios.
    public function pedidosConUsuarios()
    {
        $pedidos = Pedido::with('usuario:id,nombre,correo')->get();
        return response()->json($pedidos);
    }

    // 4. Recupera todos los pedidos cuyo total esté en el rango de $100 a $250.
    public function pedidosEnRango()
    {
        $pedidos = Pedido::whereBetween('total', [100, 250])->get();
        return response()->json($pedidos);
    }

    // 5. Encuentra todos los usuarios cuyos nombres comiencen con la letra "R".
    public function usuariosConR()
    {
        $usuarios = Usuario::where('nombre', 'like', 'R%')->get();
        return response()->json($usuarios);
    }

    // 6. Calcula el total de registros en la tabla de pedidos para el usuario con ID 5.
    public function totalPedidosUsuario5()
    {
        $total = Pedido::where('id_usuario', 5)->count();
        return response()->json(['total_pedidos' => $total]);
    }

    // 7. Recupera todos los pedidos junto con la información de los usuarios, ordenándolos de forma descendente según el total del pedido.
    public function pedidosOrdenadosPorTotal()
    {
        $pedidos = Pedido::with('usuario')->orderBy('total', 'desc')->get();
        return response()->json($pedidos);
    }

    // 8. Obtén la suma total del campo "total" en la tabla de pedidos.
    public function sumaTotalPedidos()
    {
        $suma = Pedido::sum('total');
        return response()->json(['suma_total' => $suma]);
    }

    // 9. Encuentra el pedido más económico, junto con el nombre del usuario asociado.
    public function pedidoMasEconomico()
    {
        $pedido = Pedido::with('usuario:id,nombre')->orderBy('total', 'asc')->first();
        return response()->json($pedido);
    }

    // 10. Obtén el producto, la cantidad y el total de cada pedido, agrupándolos por usuario.
    public function pedidosAgrupadosPorUsuario()
    {
        $pedidos = Usuario::with(['pedidos:id,producto,cantidad,total,id_usuario'])
            ->get()
            ->map(function ($usuario) {
                return [
                    'usuario' => $usuario->nombre,
                    'pedidos' => $usuario->pedidos
                ];
            });
        return response()->json($pedidos);
    }


    public function debug()
    {
        $usuarios = Usuario::all();
        $pedidos = Pedido::all();
        return response()->json([
            'usuarios' => $usuarios,
            'pedidos' => $pedidos
        ]);
    }
}

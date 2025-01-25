<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Pedido;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios
        $usuarios = [
            ['nombre' => 'Juan', 'correo' => 'juan@example.com', 'telefono' => '1234567890'],
            ['nombre' => 'Maria', 'correo' => 'maria@example.com', 'telefono' => '0987654321'],
            ['nombre' => 'Roberto', 'correo' => 'roberto@example.com', 'telefono' => '1122334455'],
            ['nombre' => 'Ana', 'correo' => 'ana@example.com', 'telefono' => '5544332211'],
            ['nombre' => 'Ricardo', 'correo' => 'ricardo@example.com', 'telefono' => '9988776655'],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::create($usuario);
        }

        // Crear pedidos
        $pedidos = [
            ['producto' => 'Laptop', 'cantidad' => 1, 'total' => 1000, 'id_usuario' => 1],
            ['producto' => 'Mouse', 'cantidad' => 2, 'total' => 50, 'id_usuario' => 1],
            ['producto' => 'Teclado', 'cantidad' => 1, 'total' => 100, 'id_usuario' => 2],
            ['producto' => 'Monitor', 'cantidad' => 1, 'total' => 200, 'id_usuario' => 2],
            ['producto' => 'Impresora', 'cantidad' => 1, 'total' => 150, 'id_usuario' => 3],
            ['producto' => 'Disco Duro', 'cantidad' => 2, 'total' => 180, 'id_usuario' => 4],
            ['producto' => 'Memoria RAM', 'cantidad' => 1, 'total' => 80, 'id_usuario' => 5],
        ];

        foreach ($pedidos as $pedido) {
            Pedido::create($pedido);
        }
    }
}
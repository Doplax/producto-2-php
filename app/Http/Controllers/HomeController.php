<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Bienvenido a Isla Transfers',
            'description' => 'Tu servicio de traslados en la isla. Aquí puedes presentar la aplicación, sus características y funcionamiento.'
        ];

        return view('home', $data);
    }

    public function test(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Endpoint funcionando'
        ]);
    }

    public function testdb()
    {
        try {
            \DB::connection()->getPdo();
            $dbname = \DB::connection()->getDatabaseName();
            
            return "✅ Conexión exitosa a la base de datos: " . $dbname . ".";
        } catch (\Exception $e) {
            return "❌ Error al conectar a la base de datos: " . $e->getMessage();
        }
    }
}

<?php
// Controlador
namespace App\Http\Controllers;

use App\Models\Autobus;
use App\Models\Horario;
use App\Models\Conductor;
use App\Models\Pregunta; // Cambia PreguntaFrecuente a Pregunta
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicsController extends Controller
{
    public function index(Request $request)
    {
        $autobuses = Autobus::all();
        $horarios = Horario::all();
        $conductores = Conductor::all();
        $preguntas = Pregunta::all();
        $today = Carbon::today('America/Caracas');


        $horarios_hoy = Horario::whereDate('created_at', $today)
            ->get();

        if ($horarios_hoy->isEmpty()) {
            $mensaje = "No hay horarios disponibles para hoy.";
        } else {
            $mensaje = null;
        }
        return view('public', compact('autobuses', 'horarios', 'conductores', 'preguntas', 'today', 'horarios_hoy'))
            ->with('i');
    }

    public function about()
    {
        $autobuses = Autobus::all();
        $conductores = Conductor::all();
        $imagenes = [
            (object) ['url' => 'img/imagen4.jpg'],
            (object) ['url' => 'img/imagen2.jpg'],
            (object) ['url' => 'img/imagen3.jpg'],
        ];
        return view('about', compact('autobuses', 'conductores', 'imagenes'));
    }

    // Controlador
    public function descargarPDF()
    {
        $rutaArchivo = 'pdf/prueba.pdf'; // Ajusta la ruta según tu configuración
    
        return response()->download($rutaArchivo, 'Manual De Usuario.pdf');
    }
    
}

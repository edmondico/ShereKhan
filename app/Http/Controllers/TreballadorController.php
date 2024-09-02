<?php

namespace App\Http\Controllers;

use App\Models\Treballador;
use App\Models\Contrata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importa la clase Log para registrar mensajes
use Yajra\DataTables\DataTables;

class TreballadorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Treballador::with('contrata', 'responsable')->get();

                Log::info('Datos de trabajadores recuperados:', ['data' => $data->toArray()]);

                return DataTables::of($data)
                    ->addColumn('action', function ($row) {
                        $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm ms-2"><i class="fa fa-trash"></i></a>';
                        return $editBtn . $deleteBtn;
                    })
                    ->addColumn('contrata_nom', function ($row) {
                        $contrataName = $row->contrata ? $row->contrata->nom_fiscal : '---';  // Aquí aseguramos que se está utilizando la columna correcta
                        Log::info('Nombre de contrata:', ['contrata_nom' => $contrataName]);
                        return $contrataName;
                    })
                    ->addColumn('responsable_nom', function ($row) {
                        $responsableName = $row->responsable ? $row->responsable->nom . ' ' . $row->responsable->cognom : '---';
                        Log::info('Nombre del responsable:', ['responsable_nom' => $responsableName]);
                        return $responsableName;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Error en el controlador TreballadorController@index', ['error' => $e->getMessage()]);
                return response()->json(['error' => 'Error al cargar los datos'], 500);
            }
        }

        $contratas = Contrata::all();
        $treballadors = Treballador::all();

        return view('treballadors.index', compact('contratas', 'treballadors'));
    }


    public function store(Request $request)
    {
        // Mapeo de valores de 'genere'
        $genereMap = [
            'home' => 'M',
            'dona' => 'F',
            'altre' => 'O',
        ];

        $request->merge([
            'genere' => $genereMap[$request->genere] ?? $request->genere,
        ]);

        // Validación
        $request->validate([
            'id_contrata' => 'required|exists:contratas,id',
            'nom' => 'required|string|max:255',
            'cognom' => 'required|string|max:255',
            'dni' => 'required|string|max:9|unique:treballadors,dni,' . $request->treballador_id,
            'mail' => 'required|string|email|max:255|unique:treballadors,mail,' . $request->treballador_id,
            'telefon' => 'required|string|max:15',
            'data_naixement' => 'required|date',
            'genere' => 'required|in:M,F,O',  // Ajusta para aceptar los valores correctos
            'id_responsable' => 'nullable|exists:treballadors,id',
            'telefon_empresa' => 'required|string|max:15',
        ]);

        Treballador::updateOrCreate(
            ['id' => $request->treballador_id],
            $request->all()
        );

        return response()->json(['success' => 'Treballador saved successfully.']);
    }


    public function edit($id)
    {
        $treballador = Treballador::find($id);
        Log::info('Datos para editar:', ['treballador' => $treballador->toArray()]);
        return response()->json($treballador);
    }

    public function destroy($id)
    {
        Treballador::find($id)->delete();
        Log::info('Trabajador eliminado:', ['id' => $id]);
        return response()->json(['success' => 'Treballador deleted successfully.']);
    }
}

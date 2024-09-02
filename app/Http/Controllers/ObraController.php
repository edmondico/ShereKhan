<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Company;
use App\Models\User;
use App\Models\Riscos;
use App\Models\Contrata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ObraController extends Controller
{
    public function create(Request $request)
    {
        $company_id = $request->query('company_id');
        $company = Company::findOrFail($company_id);
        $riscos = Riscos::all();
        $contratas = Contrata::with('treballadors')->get();

        return view('obras.create', compact('company', 'contratas', 'riscos'));
    }

    public function store(Request $request)
    {
        Log::info('Datos recibidos del formulario:', $request->all()); // Log para verificar que los datos llegan al controlador

        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'presupuesto' => 'nullable|numeric',
            'riscos' => 'array|required',
            'riscos.*' => 'exists:riscos,id',
            'contratas' => 'array|required',
            'contratas.*' => 'exists:contratas,id',
            'treballadors.*' => 'array',
            'treballadors.*.*' => 'exists:treballadors,id',
            'documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $obra = Obra::create([
                'nom' => $request->input('nombre'),
                'ubicacio' => $request->input('ubicacion'),
                'estado' => $request->input('estado'),
                'data_inici' => $request->input('fecha_inicio'),
                'data_fi' => $request->input('fecha_fin'),
                'presupost' => $request->input('presupuesto'),
                'company_id' => $request->input('company_id'),
            ]);

            Log::info('Obra creada:', $obra->toArray());

            $obra->riscos()->attach($request->input('riscos'));

            foreach ($request->input('contratas') as $contrata_id) {
                $treballadors = $request->input("treballadors.$contrata_id", []);
                foreach ($treballadors as $treballador_id) {
                    DB::table('treballadors_obra')->insert([
                        'id_obra' => $obra->id,
                        'id_treballador' => $treballador_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            Log::info('Trabajadores asociados guardados correctamente.');

            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('documents/obra_' . $obra->id, $filename, 'public');
                    $obra->documents()->create(['document_path' => $path]);
                }
            }

            DB::commit();

            Log::info('Todos los datos han sido guardados exitosamente.');

            return redirect()->route('company.obras.index', $obra->company_id)
                ->with('success', 'Obra creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar la obra:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al guardar la obra: ' . $e->getMessage());
        }
    }
}

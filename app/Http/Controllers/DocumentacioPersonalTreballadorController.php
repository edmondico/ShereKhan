<?php

namespace App\Http\Controllers;

use App\Models\DocumentacioPersonalTreballador;
use App\Models\Treballador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DocumentacioPersonalTreballadorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DocumentacioPersonalTreballador::with('treballador')->get();

            return DataTables::of($data)
                ->addColumn('treballador_nom', function ($row) {
                    return $row->treballador ? $row->treballador->nom . ' ' . $row->treballador->cognom : '';
                })
                ->addColumn('descripcio', function ($row) {
                    return $row->descripcio;
                })
                ->addColumn('observacions', function ($row) {
                    return $row->observacions;
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
                    $deleteBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i></a>';
                    $viewBtn = $row->document_path ? '<a href="' . asset('storage/' . $row->document_path) . '" target="_blank" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>' : '';

                    return '<div class="table-actions">' . $editBtn . $viewBtn . $deleteBtn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $treballadors = Treballador::all();
        return view('documents.index', compact('treballadors'));
    }




    public function store(Request $request)
    {
        $request->validate([
            'id_treballador' => 'required|exists:treballadors,id',
            'nom_document' => 'required|string|max:255',
            'data_expedicio' => 'nullable|date',
            'tipus_document' => 'required|in:identificacio,formacio,contracte,altre',
            'estat' => 'required|in:pendent,validat,rebutjat',
            'document_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $document = $request->id ? DocumentacioPersonalTreballador::findOrFail($request->id) : new DocumentacioPersonalTreballador();

            $document->id_treballador = $request->id_treballador;
            $document->nom_document = $request->nom_document;
            $document->data_expedicio = $request->data_expedicio;
            $document->tipus_document = $request->tipus_document;
            $document->descripcio = $request->descripcio;
            $document->observacions = $request->observacions;
            $document->estat = $request->estat;

            if ($request->hasFile('document_path')) {
                if ($document->document_path) {
                    Storage::disk('public')->delete($document->document_path);
                }
                $file = $request->file('document_path');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('documents', $filename, 'public');
                $document->document_path = $path;
            }

            $document->save();

            return response()->json(['success' => 'Documento guardado correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error al guardar documento:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al guardar el documento'], 500);
        }
    }


    public function edit($id)
    {
        try {
            $document = DocumentacioPersonalTreballador::findOrFail($id);

            // Añade la URL del documento para que se pueda previsualizar
            $document->document_url = $document->document_path ? asset('storage/' . $document->document_path) : null;

            return response()->json($document);
        } catch (\Exception $e) {
            Log::error('Error al editar documento:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al obtener el documento'], 500);
        }
    }


    public function destroy($id)
    {
        try {
            $document = DocumentacioPersonalTreballador::findOrFail($id);

            // Eliminar el archivo asociado si existe
            if ($document->document_path) {
                Storage::disk('public')->delete($document->document_path);
            }

            $document->delete();

            return response()->json(['success' => 'Documento eliminado correctamente.']);
        } catch (\Exception $e) {
            Log::error('Error al eliminar documento:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al eliminar el documento'], 500);
        }
    }
}

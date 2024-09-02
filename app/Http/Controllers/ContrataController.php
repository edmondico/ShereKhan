<?php

namespace App\Http\Controllers;

use App\Models\Contrata;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContrataController extends Controller
{
    public function index()
    {
        return view('contratas.index');
    }

    public function getContratas(Request $request)
    {
        if ($request->ajax()) {
            $data = Contrata::all();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $edit = __('messages.edit');
                    $delete = __('messages.delete');
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> ' . $edit . '</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> ' . $delete . '</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_fiscal' => 'required|string|max:255',
            'nom_comercial' => 'required|string|max:255',
            'cif' => 'required|string|max:255',
            'mail' => 'nullable|string|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096', // Cambiar a 4096 KB (4 MB)
            'color' => 'nullable|string|max:7',
            'descripcio_activitat' => 'nullable|string',
        ]);


        $logoPath = $request->file('logo') ? $request->file('logo')->store('logos', 'public') : $request->logo_hidden;

        Contrata::updateOrCreate(
            ['id' => $request->contrata_id],
            [
                'nom_fiscal' => $request->nom_fiscal,
                'nom_comercial' => $request->nom_comercial,
                'cif' => $request->cif,
                'direccio' => $request->direccio,
                'mail' => $request->mail, // Asegúrate de que se está guardando
                'logo' => $logoPath,
                'color' => $request->color,
                'descripcio_activitat' => $request->descripcio_activitat,
            ]
        );

        return response()->json(['success' => 'Contrata saved successfully.']);
    }


    public function edit($id)
    {
        $contrata = Contrata::find($id);
        return response()->json($contrata);
    }

    public function destroy($id)
    {
        Contrata::find($id)->delete();
        return response()->json(['success' => 'Contrata deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Riscos;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiscController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Riscos::all();
            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $edit = __('messages.edit');
                    $delete = __('messages.delete');
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-warning btn-sm"><i class="fa fa-edit"></i> '.$edit.'</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> '.$delete.'</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('riscos.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'nullable|string',
            'epi' => 'nullable|string',
            'observacions' => 'nullable|string',
            'grau_de_risc' => 'required|string',
            'requisits' => 'nullable|string',
        ]);

        Riscos::updateOrCreate(
            ['id' => $request->risc_id],
            $request->all()
        );

        return response()->json(['success' => 'Risc saved successfully.']);
    }

    public function edit($id)
    {
        $risc = Riscos::find($id);
        return response()->json($risc);
    }

    public function destroy($id)
    {
        Riscos::find($id)->delete();
        return response()->json(['success' => 'Risc deleted successfully.']);
    }
}

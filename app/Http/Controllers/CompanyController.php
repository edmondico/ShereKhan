<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\Obra;

class CompanyController extends Controller
{
    public function index()
    {
        return view('companies.index');
    }

    public function getCompanies()
    {
        $companies = Company::all();
        return DataTables::of($companies)
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm mx-1"><i class="fas fa-edit"></i></a>';
                $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo']) // Permitir HTML en columnas específicas
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'nif' => 'nullable',
            'ubicacio' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable',
            'descripcio' => 'nullable',
        ]);

        $logoName = null;
        if ($request->hasFile('logo')) {
            $logoName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public', $logoName);
        } else {
            $logoName = $request->logo_hidden;
        }

        Company::updateOrCreate(['id' => $request->company_id], [
            'nom' => $request->nom,
            'nif' => $request->nif,
            'ubicacio' => $request->ubicacio,
            'logo' => $logoName,
            'color' => $request->color,
            'descripcio' => $request->descripcio,
        ]);

        return response()->json(['success' => 'Company saved successfully.']);
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }
        $company->delete();
        return response()->json(['success' => 'Company deleted successfully.']);
    }
    public function showObras(Company $company)
    {
        // Cargar las obras con el estado asociado
        $obras = Obra::whereHas('companies', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->with('companies', 'riscos', 'contratas', 'contratas.treballadors')->get();

        return view('companies.obras', compact('company', 'obras'));
    }
}

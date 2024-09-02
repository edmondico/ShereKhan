<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Obra;
use Illuminate\Http\Request;

class CompanyObrasController extends Controller
{
    public function index(Company $company)
    {
        $obras = $company->obras()->get();
        return view('company.obras.index', compact('company', 'obras'));
    }

    public function show(Company $company, Obra $obra)
    {
        return view('company.obras.show', compact('company', 'obra'));
    }
}

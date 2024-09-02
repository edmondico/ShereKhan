@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nou Risc</h2>
    <form action="{{ route('riscos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcio" class="form-label">Descripció</label>
            <textarea class="form-control" id="descripcio" name="descripcio">{{ old('descripcio') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="epi" class="form-label">EPI</label>
            <textarea class="form-control" id="epi" name="epi">{{ old('epi') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="observacions" class="form-label">Observacions</label>
            <textarea class="form-control" id="observacions" name="observacions">{{ old('observacions') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="grau_de_risc" class="form-label">Grau de Risc</label>
            <select class="form-select" id="grau_de_risc" name="grau_de_risc" required>
                <option value="Baix">Baix</option>
                <option value="Mitjà">Mitjà</option>
                <option value="Alt">Alt</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="requisits" class="form-label">Requisits</label>
            <textarea class="form-control" id="requisits" name="requisits">{{ old('requisits') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
        <a href="{{ route('riscos.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection

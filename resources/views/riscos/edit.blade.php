@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edita Risc</h2>
    <form action="{{ route('riscos.update', $risc) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $risc->nom) }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcio" class="form-label">Descripció</label>
            <textarea class="form-control" id="descripcio" name="descripcio">{{ old('descripcio', $risc->descripcio) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="epi" class="form-label">EPI</label>
            <textarea class="form-control" id="epi" name="epi">{{ old('epi', $risc->epi) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="observacions" class="form-label">Observacions</label>
            <textarea class="form-control" id="observacions" name="observacions">{{ old('observacions', $risc->observacions) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="grau_de_risc" class="form-label">Grau de Risc</label>
            <select class="form-select" id="grau_de_risc" name="grau_de_risc" required>
                <option value="Baix" {{ $risc->grau_de_risc == 'Baix' ? 'selected' : '' }}>Baix</option>
                <option value="Mitjà" {{ $risc->grau_de_risc == 'Mitjà' ? 'selected' : '' }}>Mitjà</option>
                <option value="Alt" {{ $risc->grau_de_risc == 'Alt' ? 'selected' : '' }}>Alt</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="requisits" class="form-label">Requisits</label>
            <textarea class="form-control" id="requisits" name="requisits">{{ old('requisits', $risc->requisits) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualitzar</button>
        <a href="{{ route('riscos.index') }}" class="btn btn-secondary">Cancel·lar</a>
    </form>
</div>
@endsection

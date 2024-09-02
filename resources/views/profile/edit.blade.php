@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('messages.edit_profile') }}</h2>

    <form action="{{ route('profile.update') }}" method="POST" id="profile-form">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="locale" class="form-label">{{ __('messages.default_locale') }}</label>
            <select name="locale" id="locale" class="form-select" required>
                <option value="en" {{ $user->locale == 'en' ? 'selected' : '' }}>English</option>
                <option value="es" {{ $user->locale == 'es' ? 'selected' : '' }}>Español</option>
                <option value="ca" {{ $user->locale == 'ca' ? 'selected' : '' }}>Català</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="theme" class="form-label">{{ __('messages.default_theme') }}</label>
            <select name="theme" id="theme" class="form-select" required>
                <option value="light" {{ $user->theme == 'light' ? 'selected' : '' }}>{{ __('messages.light') }}</option>
                <option value="dark" {{ $user->theme == 'dark' ? 'selected' : '' }}>{{ __('messages.dark') }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
    </form>

    <hr>

    <h3>{{ __('messages.change_password') }}</h3>
    <form action="{{ route('profile.update_password') }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('messages.current_password') }}</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">{{ __('messages.new_password') }}</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">{{ __('messages.confirm_new_password') }}</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
    </form>
</div>

@push('scripts')
<script>
    document.getElementById('theme').addEventListener('change', function() {
        document.body.className = this.value + '-mode';
    });

    document.getElementById('locale').addEventListener('change', function() {
        document.getElementById('profile-form').submit();
    });
</script>
@endpush

@endsection

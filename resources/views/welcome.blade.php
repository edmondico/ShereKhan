@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="jumbotron text-center">
        <img src="http://172.16.90.191/images/logo.png" alt="Logo" style="height: 100px;">
        <h1 class="display-4 ">{{ __('messages.welcome') }}</h1>
        <p class="lead titol_welcome">{{ __('messages.welcome_sub') }}</p>
        <hr class="my-4">
        <p>{{ __('messages.welcome_sub2') }}</p>
        <a class="btn btn-secundari btn-lg" href="#" role="button">Accés</a>
    </div>
</div>
@endsection

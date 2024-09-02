<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <!-- Aquí puedes añadir tu tarjeta (card) -->
                    <div class="card">
                        <div class="card-header">
                        <p class="mb-4 titol">{{ __('messages.companies') }}</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Título de la tarjeta</h5>
                            <p class="card-text">Algún texto de ejemplo rápido para construir sobre el título de la tarjeta y componer la mayor parte del contenido de la tarjeta.</p>
                            <a href="#" class="btn btn-primary">Ir a algún lugar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

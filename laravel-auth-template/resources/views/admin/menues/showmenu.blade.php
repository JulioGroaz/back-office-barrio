@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <!-- Immagine del prodotto -->
                <img src="{{ asset('storage/' . $menu->image_path) }}" class="img-fluid rounded-start" alt="{{ $menu->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Titolo del prodotto -->
                    <h5 class="card-title">{{ $menu->name }}</h5>

                    <!-- Descrizione del prodotto -->
                    <p class="card-text">{{ $menu->description }}</p>

                    <!-- Prezzo del prodotto -->
                    <p class="card-text"><small class="text-body-secondary">{{ number_format($menu->price, 2) }} €</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pulsante per tornare alla lista dei prodotti -->
    <a href="{{ route('admin.menues.index') }}" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left"></i> Torna alla lista dei prodotti
    </a>
</div>
@endsection

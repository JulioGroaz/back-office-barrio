@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <!-- Aggiungi una classe per controllare l'altezza dell'immagine -->
        <img src="{{ asset('storage/' . $event->image_path) }}" class="img-fluid" alt="{{ $event->title }}" style="height: 300px; object-fit: cover;">

        <div class="card-body">
            <h5 class="card-title">{{ $event->title }}</h5>
            <p class="card-text">{{ $event->description }}</p>
            <p class="card-text"><small class="text-body-secondary">Data e ora: {{ $event->event_date_time }}</small></p>

            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
                <i class="fa-solid fa-pen-to-square"></i> Modifica
            </a>

            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo evento?')">
                    <i class="fa-solid fa-trash"></i> Elimina
                </button>
            </form>
        </div>
    </div>

    <!-- Pulsante per tornare alla lista degli eventi -->
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left"></i> Torna alla lista degli eventi
    </a>
</div>
@endsection

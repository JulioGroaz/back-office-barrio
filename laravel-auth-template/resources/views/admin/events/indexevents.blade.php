@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Sezione per il pulsante di aggiunta eventi -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista degli Eventi</h2>

        <!-- Pulsante per aggiungere un nuovo evento -->
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Aggiungi Evento
        </a>
    </div>

    <!-- Sezione per la lista degli eventi -->
    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ asset('storage/' . $event->image_path) }}" class="img-fluid" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="card-text"><small class="text-body-secondary">Data e ora: {{ $event->event_date_time }}</small></p>

                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <!-- Form per eliminare l'evento -->
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo evento?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica Evento</h2>

    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="event_date_time">Data e ora</label>
            <input type="datetime-local" name="event_date_time" class="form-control" value="{{ old('event_date_time', $event->event_date_time) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
            <small>Lascia vuoto se non vuoi cambiare immagine</small>
        </div>

        <!-- Bottone per salvare le modifiche -->
        <button type="submit" class="btn btn-primary mt-3">Salva Modifiche</button>
    </form>

    <!-- Pulsante per tornare alla lista degli eventi -->
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left"></i> Torna alla lista degli eventi
    </a>
</div>
@endsection

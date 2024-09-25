@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crea Nuovo Evento</h2>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="event_date_time">Data e Ora</label>
            <input type="datetime-local" name="event_date_time" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Crea Evento</button>
    </form>
</div>
@endsection

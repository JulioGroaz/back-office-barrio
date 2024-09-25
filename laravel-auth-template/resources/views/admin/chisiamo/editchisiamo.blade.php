@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica Sezione Chi Siamo</h2>

    <form action="{{ route('admin.chisiamo.update', $chisiamo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $chisiamo->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control" required>{{ old('description', $chisiamo->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
            @if ($chisiamo->image_path)
                <p>Immagine attuale:</p>
                <img src="{{ asset('storage/' . $chisiamo->image_path) }}" alt="{{ $chisiamo->title }}" style="max-width: 300px;">
            @endif
            <small>Lascia vuoto se non vuoi cambiare l'immagine</small>
        </div>

        <!-- Pulsante per salvare le modifiche -->
        <button type="submit" class="btn btn-primary mt-3">Salva Modifiche</button>
    </form>

    <!-- Pulsante per tornare alla lista delle sezioni -->
    <a href="{{ route('admin.chisiamo.index') }}" class="btn btn-secondary mt-3">
        <i class="fa fa-arrow-left"></i> Torna alla lista delle sezioni
    </a>
</div>
@endsection

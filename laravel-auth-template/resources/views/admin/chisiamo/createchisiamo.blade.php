@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crea Sezione Chi Siamo</h2>

    <form action="{{ route('admin.chisiamo.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Crea Sezione</button>
    </form>
</div>
@endsection

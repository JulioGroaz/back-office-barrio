@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crea Nuovo Prodotto del Menu</h2>

    <form action="{{ route('admin.menues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nome del Prodotto</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ ucfirst(str_replace('_', ' ', $category)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Crea Prodotto</button>
    </form>
</div>
@endsection

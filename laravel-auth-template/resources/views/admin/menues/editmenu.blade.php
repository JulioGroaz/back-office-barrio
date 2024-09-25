@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica Prodotto del Menu</h2>

    <form action="{{ route('admin.menues.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome del Prodotto</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea name="description" class="form-control">{{ old('description', $menu->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $menu->price) }}" required>
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ $menu->category == $category ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $category)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" class="form-control">
            @if($menu->image_path)
                <img src="{{ asset('storage/' . $menu->image_path) }}" class="img-fluid mt-2" alt="{{ $menu->name }}" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        <a href="{{ route('admin.menues.show', $menu->id) }}" class="btn btn-secondary">Annulla</a>
    </form>
</div>
@endsection

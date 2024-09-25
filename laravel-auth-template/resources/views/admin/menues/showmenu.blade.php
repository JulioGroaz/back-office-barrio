@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $menu->name }}</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $menu->image) }}" class="img-fluid" alt="{{ $menu->name }}">
        </div>
        <div class="col-md-6">
            <p><strong>Descrizione:</strong> {{ $menu->description }}</p>
            <p><strong>Categoria:</strong> {{ ucfirst(str_replace('_', ' ', $menu->category)) }}</p>
            <p><strong>Prezzo:</strong> {{ number_format($menu->price, 2) }} €</p>
            <a href="{{ route('admin.menues.edit', $menu) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Modifica</a>

            <form action="{{ route('admin.menues.destroy', $menu) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo menu?')">
                    <i class="fa-solid fa-trash"></i> Elimina
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

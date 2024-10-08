@extends('layouts.app')

@section('content')
<div class="container">
    @if(!$chisiamo->isEmpty())
        @foreach ($chisiamo as $chisiamo_item)
            <div class="card mb-3">
                <!-- Percorso corretto per visualizzare l'immagine -->
                <img src="{{ asset('storage/' . $chisiamo_item->image_path) }}" class="card-img-top" alt="{{ $chisiamo_item->title }}">

                <div class="card-body">
                    <h5 class="card-title">{{ $chisiamo_item->title }}</h5>
                    <p class="card-text">{{ $chisiamo_item->description }}</p>

                    <a href="{{ route('admin.chisiamo.edit', $chisiamo_item) }}" class="btn btn-warning">
                        <i class="fa-solid fa-pen-to-square"></i> Modifica
                    </a>

                    <form action="{{ route('admin.chisiamo.destroy', $chisiamo_item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa sezione?')">
                            <i class="fa-solid fa-trash"></i> Elimina
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif


</div>
@endsection

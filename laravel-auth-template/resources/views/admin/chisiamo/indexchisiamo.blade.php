@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sezione "Chi Siamo"</h1>
    <div class="card">
        <div class="card-body">
            <h2>{{ $chisiamo->title }}</h2>
            <p>{{ $chisiamo->description }}</p>
            @if ($chisiamo->image_path)
                <img src="{{ asset('storage/' . $chisiamo->image_path) }}" alt="{{ $chisiamo->title }}" style="max-width: 300px;">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.chisiamo.edit', $chisiamo->id) }}" class="btn btn-warning">Modifica</a>
        </div>
    </div>
</div>
@endsection

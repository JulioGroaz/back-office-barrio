@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @dump($events)
    </div>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ $event->image_path }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <p class="card-text"><small class="text-body-secondary">Data e ora: {{ $event->event_date_time }}</small></p>

                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>

                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

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

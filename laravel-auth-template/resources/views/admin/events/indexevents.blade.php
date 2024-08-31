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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

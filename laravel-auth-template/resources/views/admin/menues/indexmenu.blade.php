@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @dump($menues)
    </div>
    @foreach ($categories as $category)
        @php
            // Filtra i menù per categoria
            $filteredMenus = $menues->filter(function ($menu) use ($category) {
                return $menu->category == $category;
            });
        @endphp

        @if ($filteredMenus->isNotEmpty())
            <h2>{{ ucfirst(str_replace('_', ' ', $category)) }}</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredMenus as $menu)
                        <tr>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $menu->category)) }}</td>
                            <td>{{ number_format($menu->price, 2) }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</div>
@endsection

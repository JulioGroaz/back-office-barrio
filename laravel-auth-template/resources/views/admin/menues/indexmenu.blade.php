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
                        <th scope="col">Azioni</th> <!-- Colonna per azioni -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredMenus as $menu)
                        <tr>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $menu->category)) }}</td>
                            <td>{{ number_format($menu->price, 2) }} €</td>
                            <td>
                                <a href="{{ route('admin.menues.show', $menu) }}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.menues.edit', $menu) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                                <!-- Modifica rotta di cancellazione -->
                                <form action="{{ route('admin.menues.destroy', $menu) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo elemento dal menu?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</div>
@endsection

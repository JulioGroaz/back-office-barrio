@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista dei Prodotti del Menu</h2>

    <!-- Contenitore per filtro e pulsante allineati sulla stessa linea -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Form per selezionare le categorie da filtrare -->
        <form action="{{ route('admin.menues.index') }}" method="GET" class="d-flex align-items-center">
            <div class="form-group mb-0">
                <label for="category_filter" class="mr-2">Filtra per categoria:</label><br>
                @foreach($categories as $category)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category }}"
                               @if(is_array(request()->categories) && in_array($category, request()->categories)) checked @endif>
                        <label class="form-check-label">{{ ucfirst(str_replace('_', ' ', $category)) }}</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary ml-2">Filtra</button>
        </form>

        <!-- Pulsante per aggiungere un nuovo prodotto -->
        <a href="{{ route('admin.menues.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Aggiungi Prodotto
        </a>
    </div>

    <div class="row justify-content-center">
        @if($filteredMenus->isNotEmpty())
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">Prodotto</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Azioni</th>
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
                                <a href="{{ route('admin.menues.show', $menu->id) }}" class="btn btn-info">Vedi</a>
                                <a href="{{ route('admin.menues.edit', $menu->id) }}" class="btn btn-warning">Modifica</a>
                                <form action="{{ route('admin.menues.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nessun prodotto trovato per le categorie selezionate.</p>
        @endif
    </div>
</div>
@endsection

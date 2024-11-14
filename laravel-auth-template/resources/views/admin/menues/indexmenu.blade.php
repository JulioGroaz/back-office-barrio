@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista dei Prodotti del Menu</h2>

    <!-- Filtro per categoria -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <form action="{{ route('admin.menues.index') }}" method="GET" class="w-100">
            <!-- Scritta sopra il contenitore -->
            <label for="category_filter" class="mr-2">Filtra per categoria:</label>

            <!-- Sezione scorrevole verticale per le checkbox con bordi stondati e dimensioni ridotte -->
            <div class="form-group" style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 8px;">
                <div class="d-block" style="gap: 10px;">
                    @foreach($categories as $index => $category)
                        <div class="form-check">
                            <!-- Aggiungiamo un ID univoco per ogni checkbox -->
                            <input class="form-check-input category-checkbox" type="checkbox" id="category_{{ $index }}" name="categories[]" value="{{ $category }}"
                                   @if(is_array(request()->categories) && in_array($category, request()->categories)) checked @endif>
                            <!-- Colleghiamo l'etichetta alla checkbox con l'attributo for -->
                            <label class="form-check-label" for="category_{{ $index }}">{{ ucfirst(str_replace('_', ' ', $category)) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Filtra</button>
                <a href="{{ route('admin.menues.create') }}" class="btn btn-primary ml-2">
                    <i class="fa-solid fa-plus"></i> Aggiungi prodotto
                </a>
            </div>
        </form>
    </div>

    <!-- Tabella separate per ogni categoria -->
    @php
        // Raggruppa i prodotti per categoria
        $menusByCategory = $filteredMenus->groupBy('category');
    @endphp

    @foreach($menusByCategory as $category => $menus)
        <div class="category-table mt-4">
            <h3>{{ ucfirst(str_replace('_', ' ', $category)) }}</h3>

            <div class="table-responsive">
                <table class="table table-striped table-sm rounded-table mobile-table">
                    <thead>
                        <tr>
                            <th scope="col">Prodotto</th>
                            <!-- Nascondi descrizione su schermi piccoli -->
                            <th scope="col" class="d-none d-md-table-cell">Descrizione</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Prezzo</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr class="category-{{ strtolower($menu->category) }}">
                                <td>{{ $menu->name }}</td>
                                <!-- Nascondi descrizione su schermi piccoli -->
                                <td class="d-none d-md-table-cell">{{ Str::limit($menu->description, 50) }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $menu->category)) }}</td>
                                <td>{{ number_format($menu->price, 2) }} €</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center button-group">
                                        <a href="{{ route('admin.menues.show', $menu->id) }}" class="btn btn-info square-button mx-1">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.menues.edit', $menu->id) }}" class="btn btn-warning square-button mx-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.menues.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger square-button mx-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- Messaggio se non ci sono prodotti -->
    @if($filteredMenus->isEmpty())
        <p>Nessun prodotto trovato per le categorie selezionate.</p>
    @endif
</div>
@endsection

<!-- Aggiungi uno stile per arrotondare i bordi della tabella, il contorno nero e uniformare i pulsanti -->
<style>
    .rounded-table {
        border-radius: 10px; /* Arrotonda gli angoli della tabella */
        overflow: hidden; /* Evita che gli angoli arrotondati mostrino contenuto fuori dai bordi */
        border: 2px solid black; /* Aggiungi un bordo nero alla tabella */
    }

    /* Applica l'arrotondamento ai singoli componenti della tabella */
    .rounded-table thead th:first-child {
        border-top-left-radius: 10px;
    }
    .rounded-table thead th:last-child {
        border-top-right-radius: 10px;
    }
    .rounded-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }
    .rounded-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }

    /* Stile per uniformare i pulsanti quadrati */
    .button-group .square-button {
        width: 30px; /* Ridimensiona i pulsanti per adattarli meglio al mobile */
        height: 30px; /* Altezza uniforme per tutti i pulsanti, mantenendo un quadrato */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 0.9rem; /* Ridimensiona l'icona o il testo */
        padding: 0; /* Rimuove padding extra per mantenere la forma quadrata */
    }

    /* Stili specifici per la modalità mobile */
    @media (max-width: 768px) {
        .container {
            padding: 10px; /* Riduci il padding per adattare meglio il layout */
        }

        /* Nascondi la descrizione e comprimi altre colonne per risparmiare spazio */
        .mobile-table thead th,
        .mobile-table tbody td {
            font-size: 0.8rem; /* Riduci la dimensione del testo */
            padding: 5px; /* Riduci il padding delle celle */
        }

        /* Nascondi la colonna 'Descrizione' sui dispositivi mobili */
        .mobile-table .d-none.d-md-table-cell {
            display: none !important;
        }

        /* Adatta la larghezza dei pulsanti in base alla dimensione ridotta */
        .button-group .square-button {
            width: 30px;
            height: 30px;
            font-size: 0.8rem; /* Riduci la dimensione del testo per adattarla */
        }
    }
</style>

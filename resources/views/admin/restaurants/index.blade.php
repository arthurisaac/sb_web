@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h2>Liste des restaurants</h2>

                <a href="{{ route('restaurants.create') }}" class="btn btn-link">Ajouter</a>
                <table class="table table-responsive mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Commission</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($restaurants as $restaurant)
                        <tr>
                            <td> {{ $restaurant->id }} </td>
                            <td> {{ $restaurant->name }} </td>
                            <td> {{ $restaurant->phone_number }} </td>
                            <td> {{ $restaurant->commission }} </td>
                            <td>
                                <form id="delete-form-{{ $restaurant->id }}"
                                      action="{{ route('restaurants.destroy',$restaurant->id) }}" style="display: none;"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" onclick="deleteItem('{{ $restaurant->id }}')"></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deleteItem(id) {
            if(confirm('Voulez vous vraiement effectuer cette suppression?')){
                document.getElementById(`delete-form-${id}`).submit();
            }
        }
    </script>
@endsection
@push('scripts')

@endpush

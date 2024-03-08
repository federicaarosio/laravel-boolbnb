@extends('layouts.app')

@section('title', 'All Apartments')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-12 text-center ">
            <h1 class='py-4'>These are all your apartments, {{ Auth::user()->name }}</h1>
        </div>
        <div class="col-12">
            @if(session('message'))
                <div class="alert alert-success d-flex justify-content-between" role="alert" id="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" id="close"></button>
                </div>
            @endif
        </div>
        <div class="col-12 my-3 text-end">
            <a class="btn btn-primary" href="{{ route('apartments.create') }}">Create Apartment</a>
        </div>
        <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Address</th>
                            <th scope="col">Category</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                        <tr>
                            <td>{{ $apartment -> title }}</td>
                            <td>{{ $apartment -> address }}</td>
                            <td>{{ $apartment -> category -> name}}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('apartments.show', $apartment) }}">
                                    View
                                </a>
                                <a class="btn btn-sm btn-success" href="{{ route('apartments.edit', $apartment) }}">
                                    Edit
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $apartment->id }}">
                                    Delete
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $apartment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Delete apartment</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you really sure you want to delete "<strong>{{ $apartment->title }}</strong>" apartment?<br>
                                                After deleting, you'll not be able to restore it.
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form class="d-inline-block" action="{{ route('apartments.destroy', $apartment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Script JS --}}
    <script>
        let closebutton = document.getElementById('close');
        let alertElement = document.getElementById('alert');
        closebutton.addEventListener('click', () => {
            alertElement.classList.add('d-none');
        });
    </script>
@endsection
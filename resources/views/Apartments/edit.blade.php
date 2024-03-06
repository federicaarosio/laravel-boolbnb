@extends('layouts.app')
@section('title', 'Change')
@section('main-content')
<section class="p-5 container">
    <h1 class="text-center">Apartment modification</h1>
    {{-- Errors alert --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('apartments.update', $apartment)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $apartment->title) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $apartment->description) }}">
        </div>
        <div class="mb-3">
            <div class="mb-3">
                <label for="category_id" class="form-label">Apartment Category:</label>
                <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
                    <option selected>Please choose a category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id}}"
                        {{ $category->id == old('category_id', $apartment->category_id) ? 'selected' : '' }}
                    >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label">Rooms number</label>
            <input type="number" class="form-control" name="room_number" id="room_number" value="{{ old('room_number', $apartment->room_number) }}">
        </div>

        <div class="mb-3">
            <label for="bed_number" class="form-label">Bedrooms</label>
            <input type="number" class="form-control" name="bed_number" id="bed_number" value="{{ old('bed_number', $apartment->bed_number) }}">
        </div>

        <div class="mb-3">
            <label for="toilet_number" class="form-label">Bathrooms</label>
            <input type="number" class="form-control" name="toilet_number" id="toilet_number" value="{{ old('toilet_number', $apartment->toilet_number) }}">
        </div>

        <div class="mb-3">
            <label for="square_meters" class="form-label">Total square meters</label>
            <input type="number" class="form-control" name="square_meters" id="square_meters" value="{{ old('square_meters', $apartment->square_meters) }}">
        </div>

        <div class="mb-3">
            <label for="img_url" class="form-label">Image URL</label>
            <input type="url" class="form-control" name="img_url" id="img_url" value="{{ old('square_meters', $apartment->img_url) }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $apartment->address) }}">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" @checked(old('is_visible', $apartment->is_visible))>
                <label class="form-check-label" for="is_visible">
                    Visible
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="d-block">Services</label>
            @foreach ($services as $service)
            <div class="form-check-inline">
                <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}" id="check-{{ $service->id }}"
                @checked(in_array( $service->id, old('technologies', $apartment->services->pluck('id')->toArray())))>
                <label class="form-check-label" for="check-{{ $service->id }}">
                    {{ $service->name }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-danger">Edit</button>
    </form>
</section>
@endsection
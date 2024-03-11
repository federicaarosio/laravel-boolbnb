@extends('Apartments.layouts.create-or-edit')

@section('title', 'Modifica Appartamento')

@section('heading', 'Modifica Appartamento')

@section('action')
    {{ route('apartments.update', $apartment)}}
@endsection

@section('method')
    @method('PUT')
@endsection

@section('button-text', 'Modifica')
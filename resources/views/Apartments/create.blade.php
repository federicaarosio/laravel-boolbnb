@extends('Apartments.layouts.create-or-edit')

@section('title', 'Aggiungi Appartamento')

@section('heading', 'Aggiungi Appartamento')

@section('action')
    {{ route('apartments.store')}}
@endsection

@section('button-text', 'Crea')
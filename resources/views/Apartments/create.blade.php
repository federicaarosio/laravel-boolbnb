@extends('Apartments.layouts.create-or-edit')

@section('title', 'Create Apartment')

@section('heading', 'Add Apartment')

@section('action')
    {{ route('apartments.store')}}
@endsection

@section('button-text', 'Create')
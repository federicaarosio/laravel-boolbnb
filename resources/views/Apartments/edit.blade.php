@extends('Apartments.layouts.create-or-edit')

@section('title', 'Edit Apartment')

@section('heading', 'Edit Apartment')

@section('action')
    {{ route('apartments.update', $apartment)}}
@endsection

@section('method')
    @method('PUT')
@endsection

@section('button-text', 'Edit')
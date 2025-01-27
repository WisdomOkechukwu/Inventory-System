@extends('layouts.vertical', ['title' => 'All Product'])

@section('css')
    @vite(['node_modules/nouislider/dist/nouislider.min.css'])
@endsection

@section('content')
    @livewire('point-of-sale', ['reference' => $reference])
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/ecommerce-product.js'])
@endsection

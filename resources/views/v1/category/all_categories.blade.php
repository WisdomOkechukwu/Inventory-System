@extends('layouts.vertical', ['title' => 'Categories List'])

@section('content')

@livewire('category-component');

@endsection
@section('script-bottom')
@vite(['resources/js/pages/ecommerce-product-details.js'])
@endsection
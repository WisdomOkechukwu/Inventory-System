@extends('layouts.vertical', ['title' => 'In Stock'])

@section('content')

    @livewire('in-stock-component')


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection
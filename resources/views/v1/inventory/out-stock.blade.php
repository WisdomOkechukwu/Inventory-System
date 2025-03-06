@extends('layouts.vertical', ['title' => 'Out Of Stock'])

@section('content')


@livewire('out-of-stock-component')


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection
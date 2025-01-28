@extends('layouts.vertical', ['title' => 'Widgets'])

@section('content')

    @livewire('dashboard')


@endsection

@section('script-bottom')
@vite(['resources/js/pages/widgets.js'])
@endsection
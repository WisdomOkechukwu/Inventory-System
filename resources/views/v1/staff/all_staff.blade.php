@extends('layouts.vertical', ['title' => 'Staff List('.number_format($total_staff).')'])

@section('content')
@livewire('staff-component')
@endsection

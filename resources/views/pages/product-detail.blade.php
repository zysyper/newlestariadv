@extends('layouts.app')

@section('content')
    @livewire('pages.product-detail-page', ['slug' => $slug])

@endsection

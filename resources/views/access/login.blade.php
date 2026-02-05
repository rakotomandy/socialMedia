@extends('layout.layout')

@section('title', 'login')

@section('content')
  <x-login />
@endsection

@push('scripts')
  <script src="{{ asset('js/access/login.js') }}"></script>
@endpush


@push('styles')
  <style>
    body {
      background-color: #6e8ac2;
    }
  </style>
@endpush
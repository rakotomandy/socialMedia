@extends('layout.layout')

@section('title', 'home')

@section('content')
<x-sidebar :email="$email" :usersLogin="$usersLogin"/>
<x-home :email="$email" :usersLogin="$usersLogin"/>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('aside');
        const toggleButton = document.querySelector('#toggleButton');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
    });

</script>
@endpush

@push('styles')
<style>
   

    .collapsed {
        width: 4rem;
    }

    .collapsed .label,
    .collapsed .fa-solid {
        opacity: 0;
        pointer-events: none;
    }

    .collapsed #toggleButton {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 10;
        transition: all 0.3s ease-in-out;
    }

</style>
@endpush

@extends('layout.layout')

@section('title', 'Reset Password')

@section('content')
<x-reset-password :token="$token" :email="$email" />
@endsection
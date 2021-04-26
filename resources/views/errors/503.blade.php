@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('image')
 <img class="img-fluid p-3"  src="{{ asset('assets/illustration/503-illustration.svg') }}">
@endsection
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))

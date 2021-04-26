@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('image')
 <img class="img-fluid p-3"  src="{{ asset('assets/illustration/403-illustration.svg') }}">
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))

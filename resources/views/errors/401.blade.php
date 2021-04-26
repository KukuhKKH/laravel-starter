@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('image')
 <img class="img-fluid p-3"  src="{{ asset('assets/illustration/401-illustration.svg') }}">
@endsection
@section('message', __('Unauthorized'))

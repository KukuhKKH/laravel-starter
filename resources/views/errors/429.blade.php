@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('image')
 <img class="img-fluid p-3"  src="{{ asset('assets/illustration/429-illustration.svg') }}">
@endsection
@section('message', __('Too Many Requests'))

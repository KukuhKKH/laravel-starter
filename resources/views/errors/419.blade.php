@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('image')
 <img class="img-fluid p-3" src="{{ asset('assets/illustration/419-illustration.svg') }}">
@endsection
@section('message', __('Page Expired'))

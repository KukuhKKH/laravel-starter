@extends('errors::illustrated-layout')

@section('title', __('404 Not Found'))
@section('image')
 <img class="img-fluid p-3" src="{{ asset('assets/illustration/404-illustration.svg') }}">
@endsection
@section('message', __('Halaman Tidak Ditemukan'))

@extends('layout.template')
@section('page_title', 'Dashboard')
@section('title_description', 'Página inicial')
{{-- @section('page_name', 'Pre Award') --}}
@section('page_title_', 'App')
@section('page_title_active', 'Dashboard')
@section('user_role', session('role_name'))
@section('user_name', session('user_name'))

@section('content')
 
@endsection

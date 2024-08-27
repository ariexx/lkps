@extends('adminlte::page')

@section('title', 'Dashboard Superadmin')

@section('content_header')
    <h1>Dashboard Superadmin</h1>
@stop

@section('content')
    <x-adminlte-info-box title="Hai {{user()->name}}!" text="Selamat datang di halaman dashboard" theme="info" icon="fas fa-user-tie" />
@stop

@extends('adminlte::page')

@section('title', 'Dashboard Admin Prodi')

@section('content_header')
    <h1>Dashboard Admin Prodi</h1>
@stop

@section('content')
    <x-adminlte-info-box title="Hai {{user()->name}}!" text="Selamat datang di halaman dashboard" theme="info" icon="fas fa-user-tie" />
@stop

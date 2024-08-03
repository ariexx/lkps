@extends('adminlte::page')

@section('title', 'Dashboard Dosen')

@section('content_header')
    <h1>Dashboard Dosen</h1>
@stop

@section('content')
    <x-adminlte-info-box title="Hai {{user()->name}}!" text="Selamat datang di halaman dashboard dosen" theme="info" icon="fas fa-user-tie" />
@stop

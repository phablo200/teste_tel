@extends('extends.layout')
@section('content')
<h1>Bem vindo, {{ucfirst(Auth::user()->nome)}}</h1>
@endsection
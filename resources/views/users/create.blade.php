@extends('layouts.app')
@section('title','Adicionar Usuário')
@section('content')

<h1>Adicionar usuário</h1>
@include('includes.validations-form');
<form action="{{route('users.store')}}" method="post">
    @include('users._partials.form')
</form>
@endsection
@extends('layouts.app')
@section('title','Detalhe do Usuário')
@section('content')

<h1>Detalhe do usuário: {{$user->name}}</h1>

<ul>
    <li>{{$user->name}}</li>
    <li>{{$user->email}}</li>
    <li>{{$user->created_at}}</li>
</ul>



@endsection
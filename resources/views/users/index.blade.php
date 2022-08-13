@extends('layouts.app')

@section('title','Lista de Usuários')
@section('content')
<h1>
    Listagem de usuários
    (<a href="{{route('users.create')}}">+</a>)
</h1>
<form action="{{route('users.index')}}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button type="button">Pesquisar</button>
</form>

<ul>
@foreach($users as $user)
    <li>
        {{$user->name}} - {{$user->email}} 
        | <a href="{{route('users.show',$user->id)}}">Detalhes</a> 
        | <a href="{{route('users.edit',$user->id)}}">Editar</a>
        | <form action="{{route('users.delete',$user->id)}}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Excluir</button>
        </form>
    </li>
@endforeach
</ul>
@endsection
@extends('layouts.app')
@section('title','Detalhe do Usuário')
@section('content')

<h1 class="text-2x1 font-semibold leading-tigh py-2">Detalhe do usuário: {{$user->name}}</h1>

<ul>
    <li>{{$user->name}}</li>
    <li>{{$user->email}}</li>
    <li>{{$user->created_at}}</li>
</ul>
<form action="{{ route('users.delete', $user->id) }}" method="POST" class="py-12">
    @method('DELETE')
    @csrf
    <button type="submit" class="rounded-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Deletar</button>
</form>



@endsection
@extends('layouts.app2')
@section('content')
    @include('shared.header')

    <div class="container w-4/5 h-screen ml-40  border-2 border-x-blue-300 ">
        <div class="flex flex-col justify-between items-center flex-no-wrap">

                <div class="card border-2 min-h-full  w-1/2 m-6 px-10 bg-slate-100">

                    <b>{{$author->name}}</b>
                    <i>{{$author->email}}</i><br>
                    Roles: {{auth()->user()->getRoleNames()}}

                    @can('block users')
                        <form action="{{route('block.user', $author->id)}}" method="POST">
                            @csrf
                            <input type="date" name="expire" placeholder="Выберите срок действия банна">
                            <input type="submit" value="{{$action}}">
                        </form>
                    @endcan

                    @if(isset($author->posts))
                    <a class="text-green-500" href="/list/{{$author->slug}}">Постов {{$author->posts->count()}}</a>
                    @endif
                    <div class="text-center">

                    @if(isset($author->comments))

                        <div class="w-2/3 my-6 p-5 mt-16 border-4 border-state-600 rounded-lg shadow-lg ">
                            <i class="self-start ml-4">comments  {{$author->comments->count()}} </i>
                            @foreach($author->comments as $comment)
                                <div class=" border-1 bg-slate-300 p-2 rounded-lg">{{$comment->text}}</div>
                            @endforeach
                        </div>

                    @endif
                </div>

        </div>
        @include('shared.footer')

    </div>
@endsection

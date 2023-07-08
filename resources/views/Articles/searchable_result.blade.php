@extends('layouts.app2')
@section('content')
@include('shared.header')
<div class="container w-4/5 h-full ml-32 border-2 border-x-blue-300">
    <i class="self-start text-cyan-600"> {{ Breadcrumbs::render('home')}}</i>
    <div class="flex flex-col justify-between items-center flex-no-wrap">
        <p class="text-center text-2xl italic text-zinc-500">Результаты поиска</p>

        @foreach($posts as $post)
        <div class="card border-2 min-h-72  w-3/5 m-6 px-10 bg-slate-100">

           <div class="text-center">

               @php
           echo $post['title'];
            @endphp
               <img class="m-2" height="150" width="250" src="{{$post['featured_image']}}">
           </div>
            <div class="text-justify break-words">
                @php
                    echo $post['body'];
                @endphp
            </div>
            <a href="/article/{{$post['slug']}}">читать дальше</a>
        </div>
        @endforeach
    </div>

</div>
@endsection

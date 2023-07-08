@extends('layouts.app2')
@section('content')
@include('shared.header')
<div class="flex flex-col justify-around items-center my-5">

    <div class="border-2 border-blue-500 w-1/2 h-20  min-h-max my-2">
            <p class="text-center">Active Avtors in this month</p>
        @foreach($active_avtors_current_month as $a_a_c_m)
            <a href="/profile/{{$a_a_c_m->id}}"><i class="text-yellow-500">{{$a_a_c_m->name}}</i>: <i>{{$a_a_c_m->email}}</i>, Posts count: {{$a_a_c_m->posts_in_this_month}}(this month)</a><br>
        @endforeach

    </div>
    <div class="border-2 border-blue-500 w-1/2 h-20	 min-h-max my-2">
        <p class="text-center">Posts in this month: <i class="text-green-400">{{$posts_count_current_month}}</i></p>
        <p class="text-center">Comments in this month: <i class="text-green-400">{{$comments_stat_current_mont}}</i></p>
    </div>
    <div class="border-2 border-blue-500 w-1/2 h-20	 min-h-max my-2">Block 1</div>

</div>
@endsection

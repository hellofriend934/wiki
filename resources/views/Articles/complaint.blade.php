@extends('layouts.app2')
@section('content')
    @include('shared.header')
    <i class="self-start text-cyan-600">  {{\DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render('complaint')}}</i>

    <form action="{{route('complaint.store',request()->route()->parameter('slug'))}}" method="POST">
        @csrf
        @foreach($reasons as $reason)
                <i>{{$reason->reason}}</i>
                <input id="{{$reason->id}}" type="radio" value="{{$reason->id}}" name="reason"><br>
        @endforeach
        <textarea placeholder="u can add discription" name="info"></textarea>

            <input type="submit" value="отправить" class="border-2 p-1 rounded-lg">
    </form>

    @include('shared.footer')

@endsection

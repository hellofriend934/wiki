<nav class="w-full h-16 flex flex-row font-serif justify-around items-start  items-start box-border  bg-gradient-to-r from-cyan-500 to-blue-500">

   <div class="mt-2 ">
       <a href="/home" class="text-lime-700 text-2xl">Wiki</a>
   </div>

    @if(request()->route()->parameter('slug') && auth()->user()!==null && request()->routeIs('article'))
      <div class=" flex flex-row text-xl">
        <div><a href="{{route('bookmark.add', $post->id)}}" class="text-stone-300">   <img class="h-8 w-10" src="https://img.icons8.com/?size=512&id=S4wUZIUXzgz6&format=png" alt="bookmarks">bookmark</a></div>
      </div>
    @endif

  <div class="mt-2 ">
       <a href="{{route('author.register')}}" class="text-stone-300 text-xl">Редактор</a>
   </div>

    @can('block users')
        <div class="mt-2 ">
       <a href="{{route('admin.panel')}}" class="text-stone-300 text-xl">админ статистика</a>
      </div>
    @endcan


    <div class="mt-2 ">
        <form action="{{route('search.posts')}}" method="get">
            <input type="search" name="s" placeholder="article or author" class="w-96 h-10 focus:bg-gray-200 items-end border-2 border-orange-300	 rounded-lg">

        </form>
    </div>



    <div class="">
        <details class="dropdown mb-32">
            @if(session()->has('reply_notification'))
                @php
                    $replies[] = session('reply_notification');
                @endphp
                <summary class="m-1 btn">есть уведомления: <i class="text-green-200">{{count($replies)}}</i></summary>
            @else
                <summary class="m-1 btn" >пусто</summary>
            @endif
                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">

                @if(session()->has('reply_notification'))


                    @foreach($replies as $reply)
                            @foreach($reply as $r)

                        @if($r['user_reply_id'] == 1)
                            <a href="/article/{{$r['article_slug']}}"><i>{{$r['sender']}} :{{$r['text']}}: on {{$r['reply_on']}} </i></a>
                        @endif

                            @endforeach
                    @endforeach

                        <a class="border-2 bg-green-200" href="/clear/notification">очистить</a>
                @endif
            </ul>
        </details>
    </div>

    <div class="mt-2  w-40 flex justify-around -mt-px">
        <a href="/login" class="border-2 rounded-xl text-emerald-900	 p-1 border-time-600 bg-stone-300 hover:bg-cyan-600">Login</a>
        <a href="/register" class="text-emerald-900	 border-2 rounded-xl p-1 border-time-600 bg-stone-300  hover:bg-cyan-600">Register</a>
    </div>
</nav>
@if(session()->has('alert'))
    <div class="{{session()->get('alert.class')}}">{{session()->get('alert.message')}}</div>
@endif

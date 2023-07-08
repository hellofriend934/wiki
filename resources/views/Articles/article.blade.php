@extends('layouts.app2')
@section('content')
    @include('shared.header')

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>



    @if(session()->has('res'))
        <div class="flex items-center mb-4 bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>     {{session()->get('res')}}</p>
        </div>
    @endif


    <div class="container w-4/5 h-full ml-40  border-2 border-x-blue-300 ">
        <i class="self-start text-cyan-600"> {{ Breadcrumbs::render('article',$post->slug)}}</i>
        <div class="flex flex-col justify-between items-center flex-no-wrap">

                <div class="card border-2 min-h-full  w-full m-6 px-10 bg-slate-100 break-words">

                    <div class="text-center">
                       <b class="text-cyan-600 text-2xl"> @php
                            echo $post->title;
                        @endphp
                       </b>
                        <a href="/profile/{{$author->id}}">{{$author->name}}</a>
                        <img class="m-2"  src="{{$post->featured_image}}">
                    </div>
                    <div class="text-justify">
                        @php
                            echo $post->body;
                        @endphp
                    </div>

                @can('user-block',auth()->user())

                    @if(isset($post->comments))

                        <div class="w-2/3 mt-32  p-5 mt-16 border-4 border-state-600  shadow-lg break-words ">
                            <i class="self-start ml-4">comments  {{$post->comments->count()}} </i><br>
                            @foreach($comments as $comment)
                                @cannot('delete posts')
                                    <a href="/profile/{{$comment->user($comment->user_id)->id}}"><i>{{$comment->user($comment->user_id)->name}}: {{$comment->user($comment->user_id)->getRoleNames()[0]}}</i></a>

                                        @if($comment->comment_reply_id == null)
                                    <div class=" border-t-1 bg-slate-300 p-2 my-1 rounded-lg">{{$comment->text}}</div>
                                    @endif
                                    {{$comment->replies}}
                                @endcannot
                                @can('delete posts')
                                    @if($comment->comment_reply_id == null)
                                        <a href="/profile/{{$comment->user($comment->user_id)->id}}"><i>{{$comment->user($comment->user_id)->name}}</i></a><div class=" border-t-1 bg-slate-300 p-2 my-1 rounded-lg">{{$comment->text}}<a href="{{route('delete.comment', $comment->id)}}" class="text-red-500">del</a>
                                                {{--                                        reply--}}
                                                <style>
                                                    dialog[open] {
                                                        animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
                                                    }

                                                    dialog::backdrop {
                                                        background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
                                                        backdrop-filter: blur(3px);
                                                    }


                                                    @keyframes appear {
                                                        from {
                                                            opacity: 0;
                                                            transform: translateX(-3rem);
                                                        }

                                                        to {
                                                            opacity: 1;
                                                            transform: translateX(0);
                                                        }
                                                    }
                                                </style>

                                                <section class="ml-80 flex h-auto w-auto p-1 justify-center items-start">
                                                    <button onclick="document.getElementById('{{"myModal$comment->id"}}').showModal()" id="btn" class=" px-10 bg-gray-800 text-white rounded text shadow-xl">reply</button>
                                                </section>

                                                <dialog id="{{"myModal$comment->id"}}" class="h-auto w-11/12 md:w-1/2 p-5  bg-white rounded-md ">

                                                    <div class="flex flex-col w-full h-auto ">
                                                        <!-- Header -->
                                                        <div class="flex w-full h-auto justify-center items-center">
                                                            <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                                                                reply on: {{$comment->text}}/{{$comment->user($comment->user_id)->name}}
                                                            </div>
                                                            <div onclick="document.getElementById('{{"myModal$comment->id"}}').close();" class="flex w-1/12 h-auto justify-center cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                            </div>
                                                            <!--Header End-->
                                                        </div>
                                                        <!-- Modal Content-->
                                                        <div class="flex w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                                                            <form action="{{route('comment.store', ['id'=> $post->id, 'type'=> 'Wink\WinkPost', 'reply_id'=>$comment->id, 'reply_user_id'=>$comment->user($comment->user_id)->id])}}" method="post">
                                                                @csrf
                                                                <input type="text" name="comment" placeholder="reply">
                                                            </form>
                                                        </div>
                                                        <!-- End of Modal Content-->



                                                    </div>
                                                </dialog>



                                                {{--                                        reply end--}}
                                            </div>

                                        @endif

                                    @if($comment->replies !== null)
                                            @foreach($comment->replies as $reply)
                                            @if($reply->comment_reply_id == $comment->id)
                                                <a href="/profile/{{$comment->user($comment->user_id)->id}}"><i class="text-sm text-gray-300">{{$reply->user($reply->user_id)->name}}</i></a>
                                                <div class="pl-2 ml-5 w-2/3 border-t-1 bg-slate-300 rounded-lg"> {{$reply->text}} <i class="text-right ml-20 text-sm text-gray-100">On: {{$reply->parent->text}}</i><a href="{{route('delete.comment', $reply->id)}}" class="text-red-500">del</a>
                                                    {{--                                        reply--}}
                                                    <style>
                                                        dialog[open] {
                                                            animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
                                                        }

                                                        dialog::backdrop {
                                                            background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
                                                            backdrop-filter: blur(3px);
                                                        }


                                                        @keyframes appear {
                                                            from {
                                                                opacity: 0;
                                                                transform: translateX(-3rem);
                                                            }

                                                            to {
                                                                opacity: 1;
                                                                transform: translateX(0);
                                                            }
                                                        }
                                                    </style>

                                                    <section class="ml-80 flex h-auto w-auto justify-center items-start">
                                                        <button onclick="document.getElementById('{{"myModal$reply->id"}}').showModal()" id="btn" class=" px-10 bg-gray-800 text-white rounded text shadow-xl">reply</button>
                                                    </section>

                                                    <dialog id="{{"myModal$reply->id"}}" class="h-auto w-11/12 md:w-1/2 p-5  bg-white rounded-md ">

                                                        <div class="flex flex-col w-full h-auto ">
                                                            <!-- Header -->
                                                            <div class="flex w-full h-auto justify-center items-center">
                                                                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                                                                    reply on: {{$reply->text}}/{{$reply->user($reply->user_id)->name}}
                                                                </div>
                                                                <div onclick="document.getElementById('{{"myModal$reply->id"}}').close();" class="flex w-1/12 h-auto justify-center cursor-pointer">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                                </div>
                                                                <!--Header End-->
                                                            </div>
                                                            <!-- Modal Content-->
                                                            <div class="flex w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                                                                <form action="{{route('comment.store', ['id'=> $post->id, 'type'=> 'Wink\WinkPost', 'reply_id'=>$reply->id, 'reply_user_id'=>$reply->user($comment->user_id)->id])}}" method="post">
                                                                    @csrf
                                                                    <input type="text" name="comment" placeholder="reply">
                                                                </form>
                                                            </div>
                                                            <!-- End of Modal Content-->



                                                        </div>
                                                    </dialog>

                                                </div>

                                                    {{--                                        reply end--}}
                                            @endif


                                          @endforeach
                                        @endif

                                    @endcan
                            @endforeach
                        </div>
                      <form action="{{route('comment.store', ['id'=> $post->id, 'type'=> 'Wink\WinkPost'])}}" method="POST">
                          @csrf
                          <div class="w-2/3 p-1 shadow-lg border-4 rounded-lg -mt-2 border-box">
                              <input type="text" placeholder="text" name="comment" class="w-full p-1 ">
                          </div>
                      </form>

                    @endif

                    @endcan
                    @cannot('user-block', auth()->user())
                        <p>Вы заблокированы</p>
                    @endcannot

                    <div class="text-left">Views: {{views($post->views->count())}}</div>
                </div>

            <div class="self-end my-5 p-1 rounded-lg border-2 border-yellow-800 hover:bg-red-100">
                <a href="/complaint/{{$post->slug}}" class="text-center text-yellow-500">пожаловаться</a>
            </div>
            @can('delete posts','redact')
            <div class="self-end my-5 p-1 rounded-lg border-2 border-yellow-800 hover:bg-red-100">
                <a href="/wink/posts/{{$post->id}}" class="text-center text-yellow-500">Редактировать</a>
            </div>
            @endcan
        </div>

        @include('shared.footer')

    </div>
@endsection

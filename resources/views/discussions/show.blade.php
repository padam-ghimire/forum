@extends('layouts.app')

@section('content')
   

    <div class="card">
        @include('partials.discussion-header')
    
            <div class="card-body">
                    <div class="text-center">
                            <strong>
                                 {{$discussion->title}}
                            </strong>
                        </div>
                    <hr>
                    {!!$discussion->content !!}
            </div>
        </div>
       @foreach($discussion->replies()->simplepaginate(2) as $reply)
            <div class="card my-5">
                <div class="card-header">
                    <div class="d-flex jutify-content-between">
                        <div>
                             <img height="40px" width="40px" style="border-radius:50%;" src="{{ Gravatar::src($reply->user->email)}}" alt="" srcset="">
                             <span>{{$reply->user->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $reply->content !!}
                </div>
            </div>
       @endforeach
       {{$discussion->replies()->simplepaginate(2)->links()}}
           @auth
           <div class="card">
                <div class="card-header">
                    Add a reply
                </div>
            <form action="{{ route('replies.store',$discussion->slug)}}" method="post">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="content" id="content">
                    <trix-editor input="content"></trix-editor>
                    <button type="submit" class="btn my-2 btn-success btn-sm">Add reply</button>
                </div>
            </form>

           @else
           <div class="text-center mt-2">
             <a href="{{route('login')}}" class="btn btn-info btn-sm text-white">Sign in To add reply</a>
           </div>
           @endauth
           
        </div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection

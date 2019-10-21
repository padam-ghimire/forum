@extends('layouts.app')

@section('content')

<div class="card">
        <div class="card-header">Notifications</div>

        <div class="card-body">
        <ul class="list-group">
             @foreach ($notifications as $notification)
            <li class="list-group-item">
                @if($notification->type=='App\Notifications\NewReplyAdded')
                    New Reply was add To your discussion
                    <strong>

                        {{$notification->data['discussion']['title']}}
                    </strong>
                <a href="{{ route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary float-right">View Discussion</a>
                @endif
              

                @if($notification->type=='App\Notifications\ReplyMarkedAsBestReply')
                Your reply on
                <strong>
                    {{$notification->data['discussion']['title']}}
                </strong>
                was marked As Best reply
            <a href="{{ route('discussions.show',$notification->data['discussion']['slug'])}}" class="btn btn-primary float-right">View Discussion</a>
            @endif


            </li>
            @endforeach
        </ul>
            
               
            
        </div>
    </div>
@endsection

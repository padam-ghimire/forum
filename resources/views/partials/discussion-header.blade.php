<div class="card-header">
        <div class="d-flex justify-content-between">
           <div>
            <img height="40px" width="40px" style="border-radius:50%;" src="{{Gravatar::src($discussion->author->email)}}" alt="" srcset="">
            <span class="ml-2 font-weight-bold">
                    {{$discussion->author->name}}
            </span>
           </div>
           <div>
           <a href="{{ route('discussions.show',$discussion->slug)}}" class="btn btn-success btn-sm">view</a>
           </div>
        </div>
    </div>
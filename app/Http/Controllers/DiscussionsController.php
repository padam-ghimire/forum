<?php

namespace App\Http\Controllers;
use App\Discussion;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiscussionRequest;
use Illuminate\Support\Str;
use App\Notifications\ReplyMarkedAsBestreply;




class DiscussionsController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','verified'])->only(['store','create']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discussions.index',[
            'discussions' =>Discussion::filterByChannels()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' =>$request->content,
            'slug' => Str::slug($request->title),
            'channel_id' => $request->channel
        ]);
        session()->flash('success','Discussion created successfully.');
        return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        // dd($discussion);

        return view('discussions.show',[
            'discussion' => $discussion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reply(Discussion $discussion,Reply $reply){

        $discussion->markAsBestReply($reply);
        session()->flash('success','Marked as Best reply');
        return redirect()->back();

    }
}

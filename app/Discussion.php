<?php

namespace App;
use App\User;
use App\Reply;
use App\Notifications\ReplyMarkedAsBestreply;



class Discussion extends Model
{
    //
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getRouteKeyName(){

        return 'slug';

    }

    public function scopeFilterByChannels($builder){

        if(request()->query('channel')){

            $channel = Channel::where('slug',request()->query('channel'))->first();

            if($channel){
                return $builder->where('channel_id',$channel->id);
            }
            return $builder;
        }
        return $builder;

    }
    
    public function bestReply(){
        return $this->belongsTo(Reply::class,'reply_id');
    }
    public function replies(){

        return $this->hasMany(Reply::class);
    }
    public function markAsBestReply(Reply $reply){
        $this->update([
            'reply_id' => $reply->id
        ]);
        if( $reply->user->id == $this->author->id)
        {
            return;
        }
        $reply->user->notify(new ReplyMarkedAsBestReply($reply->discussion));
    }
}

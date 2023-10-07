<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserConversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id','to_id','message','attachment','read_status','type','chat_type'
    ];


    public function fromUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_id','id');
    }


    public function toUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_id','id');
    }
    
}

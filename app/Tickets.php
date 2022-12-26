<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = ['created_by', 'ticket_desc', 'importance', 'user_id', 'created_at'];

    public function user(){
        
        return $this->belongsTo(User::class);
    }
}

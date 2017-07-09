<?php

/**
 *
 * HASHAN KULASINGHE
 * HASHK99@GMAIL.COM
 * 09 JULY 2017
 *
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log; 

use Auth;

class Task extends Model
{
    use SoftDeletes; 
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'tasks';
  
    protected $primaryKey = 'id';
    
    /**
     * Set the added user.
     *
     * @param  string  $value
     * @return void
     */
    public function setAddedUserAttribute()
    { 
        $this->attributes['added_user'] = Auth::user()->id;
    }
 
    public function addedUser(){
        return $this->hasOne('App\User','id', 'added_user'); 
    }
    
     
}

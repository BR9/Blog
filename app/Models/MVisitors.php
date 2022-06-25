<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class MVisitors extends Model
{
    protected $table        =   'visitors';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function total(){

        $this->query        =   MVisitors::Join('blogs', 'visitors.blog_id', '=', 'blogs.id');

        if(Auth::user()->role == 2){

            $this->query->where('blogs.created_user', Auth::user()->id);

        }

        return $this->query->count();


    }

    public function where_get($where = null){

        $this->query        =   MVisitors::where($where)->first();
        return $this->query;


    }

}

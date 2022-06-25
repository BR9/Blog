<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MVisitors extends Model
{
    protected $table        =   'visitors';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function total(){

        $this->query        =   MVisitors::count();
        return $this->query;

    }

    public function where_get($where = null){

        $this->query        =   MVisitors::where($where)->first();
        return $this->query;


    }

}

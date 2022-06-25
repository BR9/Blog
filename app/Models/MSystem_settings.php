<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSystem_settings extends Model
{
    protected $table        =   'system_settings';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function get(){

        $this->query        =   MSystem_settings::first();
        return $this->query;

    }

}

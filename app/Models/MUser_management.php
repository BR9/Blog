<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class MUser_management extends Model
{
    protected $table        =   'users';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function get_all(){

        $this->query        =   MUser_management::orderBy('id', 'DESC')->get();
        return $this->query;

    }

    public function paginate_categories($search){

        $this->query        =   MUser_management::orderBy('users.id', 'DESC');

        if($search and !empty($search)){

            $this->query->where('name', 'like', '%'.$search.'%');
            $this->query->orWhere('surname', 'like', '%'.$search.'%');

        }

        return $this->query->paginate(15);

    }

    public function where_get($where = null){

        $this->query        =   MUser_management::orderBy('id', 'DESC');
        $this->query->where($where);

        return $this->query->first();

    }

    public function where_all($where = null){

        $this->query        =   MUser_management::orderBy('id', 'DESC');
        $this->query->where($where);

        return $this->query->get();

    }

}

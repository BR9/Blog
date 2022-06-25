<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DB;

class MCategory_management extends Model
{
    protected $table        =   'categories';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function get_all(){

        $this->query        =   MCategory_management::orderBy('id', 'DESC')->get();
        return $this->query;

    }

    public function paginate_categories($search){

        $this->query        =   MCategory_management::select(DB::raw('(SELECT sub_category.category_name FROM '.$this->table.' as sub_category WHERE sub_category.id = categories.sid LIMIT 1) as sub_category_name'), 'categories.*', 'users.name', 'users.surname')
            ->Join('users', 'categories.created_user', '=', 'users.id')
            ->orderBy('categories.id', 'DESC');

        if($search and !empty($search)){

            $this->query->where('category_name', 'like', '%'.$search.'%');

        }

        return $this->query->paginate(15);

    }

    public function where_get($where = null){

        $this->query        =   MCategory_management::orderBy('id', 'DESC');
        $this->query->where($where);

        return $this->query->first();

    }

    public function where_all($where = null){

        $this->query        =   MCategory_management::orderBy('id', 'DESC');
        $this->query->where($where);

        return $this->query->get();

    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Request;
use Auth;
use DB;

class MBlog_management extends Model
{
    protected $table        =   'blogs';
    protected $guarded      =   ['id'];
    use HasFactory;

    public function reports(){

        $where              =   null;

        if(Auth::user()->role == 2){

            $where          =   'WHERE created_user = '.Auth::user()->id;

        }

        $this->query        =   MBlog_management::select(DB::raw('(SELECT COUNT(id) FROM blogs '.$where.') as total_blogs'), DB::raw('(SELECT COUNT(id) FROM categories '.$where.') as total_category'));

        return $this->query->first();

    }

    public function get_all($limit = null){

        $this->query        =   MBlog_management::select(DB::raw('(SELECT COUNT(id) FROM visitors WHERE blog_id = blogs.id) as total_visitors'),'blogs.*', 'users.name', 'users.surname', 'users.profile_photo_path')->Join('users', 'blogs.created_user', '=', 'users.id')->orderBy('blogs.id', 'DESC');

        if(Auth::user()->role == 2){

            $this->query->where('created_user', Auth::user()->id);

        }

        if(!empty($limit) and $limit > 0){

            $this->query->limit($limit);

        }

        return $this->query->get();

    }

    public function paginate_blogs($search = null, $category = null){

        $this->query        =   MBlog_management::select(DB::raw('(SELECT COUNT(id) FROM visitors WHERE blog_id = blogs.id) as total_visitors'), 'blogs.*', 'users.name', 'users.surname', 'users.profile_photo_path', 'categories.category_name')
            ->Join('users', 'blogs.created_user', '=', 'users.id')
            ->Join('categories', 'blogs.category_id', '=', 'categories.id')
            ->orderBy('blogs.id', 'DESC');

        if(Auth::user()->role == 2 and Request::segment('2') == 'blog-management'){

            $this->query->where('blogs.created_user', Auth::user()->id);

        }

        if($search and !empty($search)){

            $this->query->where('blogs.blog_title', 'like', '%'.$search.'%');
            $this->query->orWhere('blogs.blog_content', 'like', '%'.$search.'%');

        }

        if($category and !empty($category) and is_numeric($category)){

            $this->query->where('blogs.category_id', $category);

        }

        return $this->query->paginate(15);

    }

    public function where_get($where = null){

        $this->query        =   MBlog_management::select('blogs.*', 'users.name', 'users.surname', 'users.profile_photo_path', 'categories.category_name', 'categories.id as category_id')
            ->Join('categories', 'blogs.category_id', '=', 'categories.id')->orderBy('blogs.id', 'DESC')
            ->Join('users', 'blogs.created_user', '=', 'users.id')->orderBy('blogs.id', 'DESC');

        if(Auth::user()->role == 2){
    
            $this->query->where('blogs.created_user', Auth::user()->id);

        }

        $this->query->where($where);

        return $this->query->first();

    }



}

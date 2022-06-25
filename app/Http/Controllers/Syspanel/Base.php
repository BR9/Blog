<?php

namespace App\Http\Controllers\Syspanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MBlog_management;
use App\Models\MVisitors;

class Base extends Controller
{

    public $blog_management, $visitors;

    public function __construct()
    {

        parent::__construct();

        $this->blog_management      =   new MBlog_management();
        $this->visitors             =   new MVisitors();

    }



    public function index(){

        $data['blogs']              =   $this->blog_management->get_all(5);
        $data['total_visitors']     =   $this->visitors->total();
        $data['reports']            =   $this->blog_management->reports();

        return view('syspanel.home')->with($data);

    }

}

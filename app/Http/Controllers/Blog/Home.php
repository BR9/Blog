<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MBlog_management;
use App\Models\MCategory_management;
use App\Models\MVisitors;




class Home extends Controller
{

    public $blog_management, $category_management, $visitors;

    public function __construct()
    {

        parent::__construct();

        $this->blog_management = new MBlog_management();
        $this->category_management = new MCategory_management();
        $this->visitors = new MVisitors();

    }


    public function index(Request $request)
    {

        $search = $request->get('s');
        $category = $request->get('cat');

        $data['blogs'] = $this->blog_management->paginate_blogs($search, $category);

        return view('blog.home')->with($data);

    }

    public function blog_detail(Request $request)
    {

        $id = $request->segment(2);

        $where = [

            'blogs.id' => $id

        ];

        $last_blogs = $this->blog_management->get_all(5);
        $blog = $this->blog_management->where_get($where);

        if (!$blog and empty($blog->id)) {

            return redirect(route('blog-home'));

        } else {

            $data['blog'] = $blog;
            $data['last_blogs'] = $last_blogs;
            $data['categories'] = $this->category_management->get_all();

            return view('blog.detail')->with($data);

        }

    }

    public function visitor_control(Request $request)
    {

        if ($request->ajax()) {

            if ($request->post('visitorId') and !empty($request->post('visitorId'))) {

                $blog = $this->blog_management->where_get(['blogs.id' => $request->post('blog')]);

                if (isset($blog) and !empty($blog->id)) {

                    $visitorControl = $this->visitors->where_get(['blog_id' => $request->post('blog'), 'visitor_id' => $request->post('visitorId')]);

                    if (!isset($visitorControl) and empty($visitorControl->id)) {

                        $param = [

                            'blog_id' => $request->post('blog'),
                            'visitor_id' => $request->post('visitorId')

                        ];

                        $this->visitors->create($param);

                    }

                }

            }

        }

    }

}
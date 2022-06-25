<?php

namespace App\Http\Controllers\Syspanel;

use App\Http\Controllers\Controller;
use App\Models\MBlog_management;
use App\Models\MCategory_management;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;

class Blog_management extends Controller
{

    public $blog_management, $category_management;

    public function __construct()
    {

        parent::__construct();

        $this->blog_management      =   new MBlog_management();
        $this->category_management  =   new MCategory_management();

    }

    public function index(Request $request){

        $search_param               =   $request->get('s');

        $data['blogs']              =   $this->blog_management->paginate_blogs($search_param);
        return view('syspanel.blog_management.list')->with($data);

    }

    public function create(){

        /** Mevcut kategorileri veritabanından alarak view içerisine gönderiyoruz. */

        $data['categories']         =   $this->category_management->get_all();

        return view('syspanel.blog_management.create')->with($data);

    }

    public function create_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'category'                  =>  'integer|nullable|exists:categories,id',
                'blog_img'                  =>  'mimes:jpg,jpeg,png,svg,webp|required',
                'blog_title'                =>  'required|min:3|max:100|unique:blogs,blog_title,'.$request->post('blog_title'),
                'blog_content'              =>  'required|min:15'

            ],[

                'category.required'         =>  'Kategori seçimi zorunludur.',
                'category.exists'           =>  'Seçili olan kategori sistemde bulunamadı',
                'blog_img.required'         =>  'Blog resmi zorunludur.',
                'blog_img.mimes'            =>  'Blog resmi sadece jpg,jpeg,png,svg,webp uzantıları ile yüklenebilir.',
                'blog_title.required'       =>  'Blog başlığı zorunludur.',
                'blog_title.min'            =>  'Kategori adı min. :min haneli olmalıdır.',
                'blog_title.max'            =>  'Kategori adı max. :max haneli olmalıdır.',
                'blog_title.unique'         =>  'Bu blog başlığı zaten kullanılıyor.',
                'blog_content.required'     =>  'Blog içeriği zorunludur.',
                'blog_content.min'          =>  'Blog içeriği min. :min haneli olmalıdır.'

            ]);

            $params                         =   [

                'category_id'               =>  $request->post('category'),
                'blog_title'                =>  $request->post('blog_title'),
                'blog_content'              =>  $request->post('blog_content'),
                'created_user'              =>  Auth::user()->id

            ];

            $img_id                 =   Str::uuid()->toString();
            $imagename              =   Auth::guard()->user()->id.'_'.$img_id.'.'.$request->file('blog_img')->getClientOriginalExtension();

            $request->file('blog_img')->move(public_path('/blog/assets/img/blog/'),$imagename);
            $params['blog_img']      =  $imagename;

            try{ /** Olası bir hata ile karşılaşma durumuna karşılık TRY - CATCH bloglarını kullanıyoruz. */

                $this->blog_management->create($params);
                return response(['status' => 1, 'msg' => 'Blog başarılı bir şekilde eklenmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

    public function edit(Request $request){

        $id                     =   $request->segment(4);

        $where                  =   [

            'blogs.id'          =>  $id

        ];

        $blog                   =   $this->blog_management->where_get($where);

        if(!$blog and empty($blog->id)){

            return redirect(route('blog-management'));

        }else{

            $data['blog']       =   $blog;
            $data['categories'] =   $this->category_management->get_all();

            return view('syspanel.blog_management.edit')->with($data);

        }


    }

    public function edit_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'category'                  =>  'integer|nullable|exists:categories,id',
                'blog_img'                  =>  'mimes:jpg,jpeg,png,svg,webp|nullable',
                'blog_title'                =>  'required|min:3|max:100',
                'blog_content'              =>  'required|min:15'

            ],[

                'category.required'         =>  'Kategori seçimi zorunludur.',
                'category.exists'           =>  'Seçili olan kategori sistemde bulunamadı',
                'blog_img.mimes'            =>  'Blog resmi sadece jpg,jpeg,png,svg,webp uzantıları ile yüklenebilir.',
                'blog_title.required'       =>  'Blog başlığı zorunludur.',
                'blog_title.min'            =>  'Kategori adı min. :min haneli olmalıdır.',
                'blog_title.max'            =>  'Kategori adı max. :max haneli olmalıdır.',
                //'blog_title.unique'         =>  'Bu blog başlığı zaten kullanılıyor.',
                'blog_content.required'     =>  'Blog içeriği zorunludur.',
                'blog_content.min'          =>  'Blog içeriği min. :min haneli olmalıdır.'

            ]);

            $params                         =   [

                'category_id'               =>  $request->post('category'),
                'blog_title'                =>  $request->post('blog_title'),
                'blog_content'              =>  $request->post('blog_content'),
                'created_user'              =>  Auth::user()->id

            ];

            if($request->file('blog_img') and !empty($request->file('blog_img'))){

                $img_id                 =   Str::uuid()->toString();
                $imagename              =   Auth::guard()->user()->id.'_'.$img_id.'.'.$request->file('blog_img')->getClientOriginalExtension();

                $request->file('blog_img')->move(public_path('/blog/assets/img/blog/'),$imagename);
                $params['blog_img']      =  $imagename;

            }

            try{

                $this->blog_management->updateOrCreate(['id' => $request->post('bid')], $params);
                return response(['status' => 1, 'msg' => 'Blog başarılı bir şekilde güncellenmiştir.'], 200);


            }catch (Throwable $e){

                return $e;

            }


        }

    }

    public function delete_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'id'                =>  'required|exists:blogs,id'

            ],[

                'id.required'       =>  'Geçersiz ya da hatalı istekte bulunuyorsunuz.',
                'id.exists'         =>  'Silmek istediğiniz kategori sistemde bulunamıyor.'

            ]);

            try{

                $this->blog_management->destroy($request->post('id'));
                return response(['status' => 1, 'msg' => 'Blog başarılı bir şekilde silinmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

}

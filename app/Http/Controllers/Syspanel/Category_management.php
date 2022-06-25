<?php

namespace App\Http\Controllers\Syspanel;

use App\Http\Controllers\Controller;
use App\Models\MCategory_management;
use Illuminate\Http\Request;

use Validator;
use Auth;

class Category_management extends Controller
{

    public $category_management;

    public function __construct()
    {

        parent::__construct();

        $this->category_management      =   new MCategory_management();

    }

    public function index(Request $request){

        $search_param               =   $request->get('s');

        $data['categories']         =   $this->category_management->paginate_categories($search_param);
        return view('syspanel.category_management.list')->with($data);

    }

    public function create(){

        /** Mevcut kategorileri veritabanından alarak view içerisine gönderiyoruz. */

        $data['categories']         =   $this->category_management->get_all();

        return view('syspanel.category_management.create')->with($data);

    }

    public function create_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'category_name'             =>  'required|min:3|max:30|unique:categories,category_name,'.$request->post('category_name'),
                'sub_category'              =>  'integer|nullable|exists:categories,id'

            ],[

                'category_name.required'    =>  'Kategori adı zorunludur.',
                'category_name.min'         =>  'Kategori adı min. :min haneli olmalıdır.',
                'category_name.max'         =>  'Kategori adı max. :max haneli olmalıdır.',
                'category_name.unique'      =>  'Bu kategori adı zaten kullanılıyor.',
                'sub_category.integer'      =>  'Alt kategori sadece sayısal bir değere sahip olmalıdır.'

            ]);

            $params                         =   [

                'category_name'             =>  $request->post('category_name'),
                'created_user'              =>  Auth::user()->id

            ];

            /** Alt kategori seçilmiş ise ekliyoruz. */

            if($request->post('sub_category') and !empty($request->post('sub_category'))){

                $params['sid']              =  $request->post('sub_category');

            }

            try{ /** Olası bir hata ile karşılaşma durumuna karşılık TRY - CATCH bloglarını kullanıyoruz. */

                $this->category_management->create($params);    
                return response(['status' => 1, 'msg' => 'Kategori başarılı bir şekilde eklenmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

    public function edit(Request $request){

        $id                     =   $request->segment(4);

        $where                  =   [

            'id'                =>  $id

        ];

        $category               =   $this->category_management->where_get($where);

        if(!$category and empty($category->id)){

            return redirect(route('category-management'));

        }else{

            $data['category']   =   $category;
            $data['categories'] =   $this->category_management->get_all();

            return view('syspanel.category_management.edit')->with($data);

        }


    }

    public function edit_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'cid'                       =>  'required|exists:categories,id',
                'category_name'             =>  'required|min:3|max:30',
                'sub_category'              =>  'integer|nullable|exists:categories,id'

            ],[

                'category_name.required'    =>  'Kategori adı zorunludur.',
                'category_name.min'         =>  'Kategori adı min. :min haneli olmalıdır.',
                'category_name.max'         =>  'Kategori adı max. :max haneli olmalıdır.',
                'category_name.unique'      =>  'Bu kategori adı zaten kullanılıyor.',
                'sub_category.integer'      =>  'Alt kategori sadece sayısal bir değere sahip olmalıdır.'

            ]);

            $params                         =   [

                'category_name'             =>  $request->post('category_name'),
                'created_user'              =>  Auth::user()->id

            ];

            /** Alt kategori seçilmiş ise ekliyoruz. */

            if($request->post('sub_category') and !empty($request->post('sub_category'))){

                $params['sid']              =  $request->post('sub_category');

            }

            try{

                $this->category_management->updateOrCreate(['id' => $request->post('cid')], $params);
                return response(['status' => 1, 'msg' => 'Kategori başarılı bir şekilde güncellenmiştir.'], 200);


            }catch (Throwable $e){

                return $e;

            }


        }

    }

    public function delete_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'id'                =>  'required|exists:categories,id'

            ],[

                'id.required'       =>  'Geçersiz ya da hatalı istekte bulunuyorsunuz.',
                'id.exists'         =>  'Silmek istediğiniz kategori sistemde bulunamıyor.'

            ]);

            try{

                $this->category_management->destroy($request->post('id'));
                return response(['status' => 1, 'msg' => 'Kategori başarılı bir şekilde silinmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

}

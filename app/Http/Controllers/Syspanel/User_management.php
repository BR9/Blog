<?php

namespace App\Http\Controllers\Syspanel;

use App\Http\Controllers\Controller;
use App\Models\MUser_management;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Validator;
use Auth;
use Hash;

class User_management extends Controller
{

    public $user_management;

    public function __construct()
    {

        parent::__construct();

        $this->user_management      =   new MUser_management();

    }

    public function index(Request $request){

        $search_param               =   $request->get('s');

        $data['users']              =   $this->user_management->paginate_categories($search_param);
        return view('syspanel.user_management.list')->with($data);

    }

    public function create(){

        /** Mevcut kategorileri veritabanından alarak view içerisine gönderiyoruz. */

        $data['users']              =   $this->user_management->get_all();

        return view('syspanel.user_management.create')->with($data);

    }

    public function create_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'user_img'                  =>  'mimes:jpg,jpeg,png,svg,webp|required',
                'user_name'                 =>  'required|min:3|max:30',
                'user_surname'              =>  'required|min:3|max:30',
                'user_email'                =>  'required|email|unique:users,email',
                'user_password'             =>  'required|min:6',
                'user_role'                 =>  'required|integer|min:1|max:2',
                'sub_category'              =>  'integer|nullable|exists:categories,id'

            ],[

                'user_img.required'         =>  'Kullanıcı fotoğrafı zorunludur.',
                'user_img.mimes'            =>  'Kullanıcı fotoğrafı sadece jpg,jpeg,png,svg,webp uzantıları ile yüklenebilir.',
                'user_name.required'        =>  'Kullanıcı adı zorunludur.',
                'user_name.min'             =>  'Kullanıcı adı min. :min haneli olmalıdır.',
                'user_name.max'             =>  'Kullanıcı adı max. :max haneli olmalıdır.',
                'user_surname.required'     =>  'Kullanıcı soyadı zorunludur.',
                'user_surname.min'          =>  'Kullanıcı soyadı min. :min haneli olmalıdır.',
                'user_surname.max'          =>  'Kullanıcı soyadı max. :max haneli olmalıdır.',
                'user_email.required'       =>  'Kullanıcı e-mail adresi zorunludur.',
                'user_email.email'          =>  'Lütfen geçerli bir e-mail adresi giriniz.',
                'user_email.unique'         =>  'Bu e-mail adresi zaten kullanımda..',
                'user_password.required'    =>  'Lütfen şifre belirleyiniz.',
                'user_password.min'         =>  'Şifre min. :min haneli olmalıdır.',
                'user_role.required'        =>  'Kullanıcı rol seçimi zorunludur.',
                'user_role.min'             =>  'Kullanıcı rolü 1 ya da 2 olmalıdır.',
                'user_role.max'             =>  'Kullanıcı rolü 1 ya da 2 olmalıdır.',
                'user_role.integer'         =>  'Kullanıcı sadece sayısal bir değer barındırabilir.'

            ]);

            $params                         =   [

                'name'                      =>  $request->post('user_name'),
                'surname'                   =>  $request->post('user_surname'),
                'email'                     =>  $request->post('user_email'),
                'role'                      =>  $request->post('user_role'),
                'password'                  =>  Hash::make($request->post('user_password'))

            ];

            $img_id                         =   Str::uuid()->toString();
            $imagename                      =   Auth::guard()->user()->id.'_'.$img_id.'.'.$request->file('user_img')->getClientOriginalExtension();

            $request->file('user_img')->move(public_path('/blog/assets/img/user/'),$imagename);
            $params['profile_photo_path']   =  $imagename;

            try{ /** Olası bir hata ile karşılaşma durumuna karşılık TRY - CATCH bloglarını kullanıyoruz. */

                $this->user_management->create($params);
                return response(['status' => 1, 'msg' => 'Kullanıcı başarılı bir şekilde eklenmiştir.'], 200);

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


        $user                  =   $this->user_management->where_get($where);

        if(!$user and empty($user->id)){

            return redirect(route('user-management'));

        }else{

            $data['user']       =   $user;
            return view('syspanel.user_management.edit')->with($data);

        }


    }

    public function edit_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'user_img'                  =>  'mimes:jpg,jpeg,png,svg,webp|nullable',
                'user_name'                 =>  'required|min:3|max:30',
                'user_surname'              =>  'required|min:3|max:30',
                'user_email'                =>  'nullable|email|unique:users,email,'.$request->post('uid'),
                'user_password'             =>  'nullable|min:6',
                'user_role'                 =>  'required|integer|min:1|max:2',
                'sub_category'              =>  'integer|nullable|exists:categories,id'

            ],[

                'user_img.mimes'            =>  'Kullanıcı fotoğrafı sadece jpg,jpeg,png,svg,webp uzantıları ile yüklenebilir.',
                'user_name.required'        =>  'Kullanıcı adı zorunludur.',
                'user_name.min'             =>  'Kullanıcı adı min. :min haneli olmalıdır.',
                'user_name.max'             =>  'Kullanıcı adı max. :max haneli olmalıdır.',
                'user_surname.required'     =>  'Kullanıcı soyadı zorunludur.',
                'user_surname.min'          =>  'Kullanıcı soyadı min. :min haneli olmalıdır.',
                'user_surname.max'          =>  'Kullanıcı soyadı max. :max haneli olmalıdır.',
                'user_email.email'          =>  'Lütfen geçerli bir e-mail adresi giriniz.',
                'user_email.unique'         =>  'Bu e-mail adresi zaten kullanımda..',
                'user_password.required'    =>  'Lütfen şifre belirleyiniz.',
                'user_password.min'         =>  'Şifre min. :min haneli olmalıdır.',
                'user_role.required'        =>  'Kullanıcı rol seçimi zorunludur.',
                'user_role.min'             =>  'Kullanıcı rolü 1 ya da 2 olmalıdır.',
                'user_role.max'             =>  'Kullanıcı rolü 1 ya da 2 olmalıdır.',
                'user_role.integer'         =>  'Kullanıcı sadece sayısal bir değer barındırabilir.'

            ]);

            $params                         =   [

                'name'                      =>  $request->post('user_name'),
                'surname'                   =>  $request->post('user_surname'),
                'email'                     =>  $request->post('user_email'),
                'role'                      =>  $request->post('user_role')
            ];

            if($request->file('user_img') and !empty($request->file('user_img'))){

                $img_id                         =   Str::uuid()->toString();
                $imagename                      =   Auth::guard()->user()->id.'_'.$img_id.'.'.$request->file('user_img')->getClientOriginalExtension();

                $request->file('user_img')->move(public_path('/blog/assets/img/user/'),$imagename);
                $params['profile_photo_path']   =  $imagename;

            }

            if($request->post('user_password') and !empty($request->post('user_password'))){

                $params['password']             =   Hash::make($request->post('user_password'));

            }

            try{

                $this->user_management->updateOrCreate(['id' => $request->post('uid')], $params);
                return response(['status' => 1, 'msg' => 'Kullanıcı başarılı bir şekilde güncellenmiştir.'], 200);


            }catch (Throwable $e){

                return $e;

            }


        }

    }

    public function delete_p(Request $request){

        if($request->ajax()){

            $request->validate([

                'id'                =>  'required|exists:users,id'

            ],[

                'id.required'       =>  'Geçersiz ya da hatalı istekte bulunuyorsunuz.',
                'id.exists'         =>  'Silmek istediğiniz kullanıcı sistemde bulunamıyor.'

            ]);

            try{

                $this->user_management->destroy($request->post('id'));
                return response(['status' => 1, 'msg' => 'Kullanıcı başarılı bir şekilde silinmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

}

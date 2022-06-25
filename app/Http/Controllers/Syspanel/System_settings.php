<?php

namespace App\Http\Controllers\Syspanel;

use App\Http\Controllers\Controller;
use App\Models\MSystem_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

use Auth;

class System_settings extends Controller
{
    public $system_settings;

    public function __construct(){

        parent::__construct();

        $this->system_settings          =   new MSystem_settings();

    }

    public function index(){

        $data['system_settings']        =   $this->system_settings->get();

        return view('syspanel.system_settings.index')->with($data);

    }

    /** Sistem ayarlarını düzenleme başlangıç */

    public function edit(Request $request){

        /** Sadece AJAX işlemlerini kabul ediyoruz. */

        if($request->ajax()){

            $request->validate([

                'title'                     =>  'required|min:5',
                'logo'                      =>  'mimes:jpg,jpeg,png,svg,webp|nullable',
                'description'               =>  'required|min:10'

            ],[

                'title.required'            =>  'Sistem başlığı zorunludur.',
                'title.min'                 =>  'Sistem başlığı min. :min haneli olmalıdır.',
                'logo.mimes'                =>  'Sistem logosu sadece jpg,jpeg,png,svg,webp uzantıları ile yüklenebilir.',
                'description.required'      =>  'Sistem açıklaması zorunludur.',

            ]);


            $maintance                      =   2;

            /** Bakım modu aktif edildi ise tanımlamalarımızı gerçekleştirip Laravel Artisan komutu ile sistemi bakım moduna alıyoruz. */

            if($request->post('maintance') and $request->post('maintance') == 1){
                $maintance                  =   1;
                Artisan::call('down', ['--secret' => '_sysadmin']);
            }else{
                Artisan::call('up'); /** Bakım modu aktif değil ise sistemi tekrardan ayağa kaldırıyoruz. */
            }

            $params                     =   [
                'title'                 =>  $request->post('title'),
                'description'           =>  $request->post('description'),
                'analytics'             =>  $request->post('analytics'),
                'maintance'             =>  $maintance
            ];

            if($request->file('logo') and !empty($request->file('logo'))){

                $img_id                 =   Str::uuid()->toString();
                $imagename              =   Auth::guard()->user()->id.'_'.$img_id.'.'.$request->file('logo')->getClientOriginalExtension();

                $request->file('logo')->move(public_path('/blog/assets/img/logo/'),$imagename);
                $params['logo']         =  $imagename;

            }

            try{ /** Olası bir hata ile karşılaşma durumuna karşılık TRY - CATCH bloglarını kullanıyoruz. */

                $this->system_settings->updateOrCreate(['id' => 1], $params);
                return response(['status' => 1, 'msg' => 'Sistem ayarları başarılı bir şekilde güncellenmiştir.'], 200);

            }catch (Throwable $e){

                return $e;

            }

        }

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\MSystem_settings;
use App\Models\MCategory_management;

use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $MSystem_settings, $system_settings, $MCategory_management, $categories;

    public function __construct()
    {

        /** Sistem ayarlarını base controller üzerinden tüm view ve controller içeriğinde çalışacak şekilde gönderiyoruz. */

        $this->MSystem_settings     =   new MSystem_settings();
        $this->system_settings      =   $this->MSystem_settings->get();
        $this->MCategory_management =   new MCategory_management();
        $this->system_settings      =   $this->MSystem_settings->get();
        $this->categories           =   $this->MCategory_management->get_all();

        View::share('system_settings', $this->system_settings);
        View::share('categories', $this->categories);

    }

}

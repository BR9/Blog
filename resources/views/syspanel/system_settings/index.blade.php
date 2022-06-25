@extends('syspanel.template')
@section('page_title', 'Sistem Ayarları')
@section('content')

    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Sistem Ayarları</h1>
            <ul>
                <li><a href="{{route('home')}}">Blog</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Sistem Ayarları</li>
            </ul>
        </section>

        <form id="cform" method="POST">

            <div class="grid lg:grid-cols-4 gap-5">
                <!-- Content -->
                <div class="lg:col-span-2 xl:col-span-3">

                    <div class="card p-5">
                        @csrf

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Mevcut Logo</label>
                            <img src="{{asset('blog')}}/assets/img/logo/{{$system_settings->logo}}" style="width:30%;">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Sistem Logosu</label>
                            <input id="logo" name="logo" type="file" class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="title">Sistem Başlığı</label>
                            <input id="title" name="title" type="text" value="{{$system_settings->title}}" class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="title">Sistem Açıklaması[Description]</label>
                            <input id="description" name="description" type="text" value="{{$system_settings->description}}" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="content">Google Analytics</label>
                            <textarea id="analytics" name="analytics" class="form-control" rows="10">{{$system_settings->analytics}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-y-5 lg:col-span-3 xl:col-span-1">

                    <!-- Publish -->
                    <div class="card p-5 flex flex-col gap-y-5">
                        <h3>Bakım Modu</h3>
                        <div class="flex items-center">
                            <div class="w-3/4 ml-2">
                                <label class="label switch">
                                    <input id="maintance" name="maintance" type="checkbox" value="1" {{($system_settings->maintance == 1) ? 'checked' : ''}}>
                                    <span></span>
                                    <span>/_sysadmin | olarak giriş yapılabilir.</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-5">
                            <button type="button" onclick="core_form('{{route('system-settings-edit-p')}}', 2, null);" class="btn btn_primary uppercase">Değişiklikleri Kaydet <i class='fa-solid fa-circle-notch fa-spin' style="display:none;margin-left:5px;"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

@endsection
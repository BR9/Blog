@extends('syspanel.template')
@section('page_title', 'Kullanıcı Düzenleme')
@section('content')

    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Kullanıcı Yönetimi</h1>
            <ul>
                <li><a href="{{route('home')}}">Blog</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Kullanıcı Düzenleme</li>
            </ul>
        </section>

        <form id="cform" method="POST">

            <div class="grid lg:grid-cols-12 gap-5">
                <!-- Content -->
                <div class="lg:col-span-2 xl:col-span-3">

                    <div class="card p-5">
                        @csrf

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Mevcut Fotoğraf</label>
                            <img src="{{asset('blog')}}/assets/img/user/{{$user->profile_photo_path}}" style="width:20%;">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Kullanıcı Fotoğrafı</label>
                            <input id="user_img" name="user_img" type="file" class="form-control">
                            <p style="color:red;font-size:11px">* Fotoğraf değiştirilmez ise mevcut kullanıcı fotoğrafı korunacaktır.</p>

                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Kullanıcı Adı</label>
                            <input id="user_name" name="user_name" type="text" value="{{$user->name}}" class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Kullanıcı Soyadı</label>
                            <input id="user_surname" name="user_surname" type="text" value="{{$user->surname}}"  class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">E-Mail Adresi</label>
                            <input id="user_email" name="user_email" type="email" value="{{$user->email}}"  class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Şifre</label>
                            <input id="user_password" name="user_password" type="password" placeholder="****" class="form-control">
                            <p style="color:red;font-size:11px">* Şifre değiştirilmez ise mevcut şifre korunacaktır.</p>

                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="title">Kullanıcı Rolü</label>
                            <select name="user_role" id="user_role" class="form-control">

                                <option value="1">Admin</option>
                                <option value="2">Yazar</option>

                            </select>

                        </div>

                        <input type="hidden" name="uid" value="{{$user->id}}">

                        <button type="button" onclick="core_form('{{route('user-management-edit-p', [$user->id])}}', 2, '{{route('user-management')}}');" class="btn btn_primary uppercase">Düzenle <i class="fa-solid fa-circle-notch fa-spin" style="display:none;margin-left:5px;"></i> </button>

                    </div>
                </div>
            </div>

        </form>

@endsection
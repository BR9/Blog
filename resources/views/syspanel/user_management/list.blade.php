@extends('syspanel.template')
@section('page_title', 'Kullanıcı Yönetimi')
@section('content')
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb lg:flex items-start">
            <div>
                <h1>Kullanıcı Yönetimi</h1>
                <ul>
                    <li><a href="{{route('home')}}">Ana Sayfa</a></li>
                    <li class="divider la la-arrow-right"></li>
                    <li>Kullanıcı Yönetimi</li>
                </ul>
            </div>

            <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">


                <!-- Search -->
                <form class="flex flex-auto items-center" action="{{route('user-management')}}" method="GET">
                    <label class="form-control-addon-within rounded-full">
                        <input type="text" id="s" name="s" class="form-control border-none" placeholder="Ara" autocomplete="off">
                        <button type="submit" class="btnSub btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                    </label>
                </form>

                <div class="flex gap-x-2">
                    <!-- Add New -->
                    <a href="{{route('user-management-create')}}" class="btn btn_primary uppercase">Yeni Kullanıcı Ekle</a>
                </div>
            </div>
        </section>

        <!-- List -->
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table class="table table-auto table_hoverable w-full">
                    <thead>
                    <tr>
                        <th class="ltr:text-left rtl:text-right uppercase">Fotoğraf</th>
                        <th class="ltr:text-left rtl:text-right uppercase">Ad Soyad</th>
                        <th class="ltr:text-left rtl:text-right uppercase">E-Mail</th>
                        <th class="text-center uppercase">Yetki</th>
                        <th class="text-center uppercase">Oluşturulma Tarihi</th>
                        <th class="uppercase"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($categories) <= 0)

                        <p style="color:red;">* Herhangi bir kategori bulunamadı.</p>
                        <hr>

                    @endif

                    @foreach($users as $p)

                        <tr>
                            <td style="width:10%;"><img src="{{asset('blog')}}/assets/img/user/{{$p->profile_photo_path}}" style="width:50%;"></td>
                            <td>{{$p->name}} {{$p->surname}}</td>
                            <td>{{$p->email}}</td>
                            <td class="text-center">{{($p->role == 1) ? 'Admin' : 'Yazar'}}</td>
                            <td class="text-center">{{date("d-m-Y", strtotime($p->created_at))}}</td>
                            <td class="ltr:text-right rtl:text-left whitespace-nowrap">
                                <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                                    <a href="{{route('user-management-edit', [$p->id])}}" class="btn btn-icon btn_outlined btn_secondary">
                                        <span class="la la-pen-fancy"></span>
                                    </a>
                                    @csrf
                                    <a onclick="core_onclick('{{route('user-management-delete-p')}}', {{$p->id}}, 'Bu kullanıcıyı silmek istediğinize emin misiniz?');" class="btn btn-icon btn_outlined btn_danger ltr:ml-2 rtl:mr-2" style="cursor:pointer;">
                                        <span class="la la-trash-alt"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>


        @if($users->hasPages())

            <div class="mt-5">
                <!-- Pagination -->
                <div class="card lg:flex">
                    <nav class="flex flex-wrap gap-2 p-5">
                        {{ $users->withQueryString()->links('pagination::bootstrap-4')  }}

                    </nav>
                </div>
            </div>

    @endif

@endsection
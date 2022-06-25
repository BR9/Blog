@extends('syspanel.template')
@section('page_title', 'Kategori Düzenleme')
@section('content')

    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Kategori Düzenleme Ekranı</h1>
            <ul>
                <li><a href="{{route('home')}}">Blog</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Kategori Düzenleme</li>
            </ul>
        </section>

        <form id="cform" method="POST">

            <div class="grid lg:grid-cols-12 gap-5">
                <!-- Content -->
                <div class="lg:col-span-2 xl:col-span-3">

                    <div class="card p-5">
                        @csrf

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Kategori Adı</label>
                            <input id="category_name" name="category_name" type="text" class="form-control" value="{{$category->category_name}}">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="title">Alt Kategori</label>
                            <select name="sub_category" id="sub_category" class="form-control">

                                <option value="">Hayır</option>

                                @foreach($categories as $p)

                                    @if($p->id != $category->id)

                                        @if($p->sid <= 0)

                                            <option value="{{$p->id}}" {{($p->id == $category->sid) ? 'selected' : ''}}>{{$p->category_name}}</option>

                                        @endif

                                    @endif

                                @endforeach

                            </select>

                        </div>

                        <input type="hidden" name="cid" value="{{$category->id}}">

                        <button type="button" onclick="core_form('{{route('category-management-edit-p', [$category->id])}}', 2, '{{route('category-management')}}');" class="btn btn_primary uppercase">Düzenle <i class="fa-solid fa-circle-notch fa-spin" style="display:none;margin-left:5px;"></i> </button>

                    </div>
                </div>
            </div>

        </form>

@endsection
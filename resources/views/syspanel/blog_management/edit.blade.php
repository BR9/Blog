@extends('syspanel.template')
@section('page_title', 'Blog Düzenleme')
@section('content')


    <script>

        $(function(){

            tinymce.init({
                selector: 'textarea',
                plugins: 'advlist link image lists',
                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
                language: 'tr',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                }

            });

        });

    </script>


    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Blog Düzenleme Ekranı</h1>
            <ul>
                <li><a href="{{route('home')}}">Blog</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Blog Düzenleme</li>
            </ul>
        </section>

        <form id="cform" method="POST">

            <div class="grid lg:grid-cols-12 gap-5">
                <!-- Content -->
                <div class="lg:col-span-2 xl:col-span-3">

                    <div class="card p-5">
                        @csrf

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="title">Bağlı Olduğu Kategori</label>
                            <select name="category" id="category" class="form-control">

                                @foreach($categories as $p)

                                        <option value="{{$p->id}}" {{($p->id == $blog->category_id) ? 'selected' : ''}}>{{$p->category_name}}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Mevcut Blog Resmi</label>
                            <img src="{{asset('blog')}}/assets/img/blog/{{$blog->blog_img}}" style="width:15%;">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Yeni Blog Resmi</label>
                            <input id="blog_img" name="blog_img" type="file" class="form-control">
                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Blog Başlığı</label>
                            <input id="blog_title" name="blog_title" value="{{$blog->blog_title}}" type="text" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="slug">Blog İçeriği</label>
                            <textarea id="blog_content" name="blog_content" type="text" class="form-control">{{$blog->blog_content}}</textarea>
                        </div>

                        <input type="hidden" name="bid" value="{{$blog->id}}">

                        <button type="button" onclick="core_form('{{route('blog-management-edit-p', [$blog->id])}}', 2, '{{route('blog-management')}}');" class="btn btn_primary uppercase">Düzenle <i class="fa-solid fa-circle-notch fa-spin" style="display:none;margin-left:5px;"></i> </button>

                    </div>
                </div>
            </div>

        </form>

@endsection
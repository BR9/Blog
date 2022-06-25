@extends('syspanel.template')
@section('page_title', 'Blog Ekleme')
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
            <h1>Blog Yönetimi</h1>
            <ul>
                <li><a href="{{route('home')}}">Blog</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Blog Ekleme</li>
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

                                    <option value="{{$p->id}}">{{$p->category_name}}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Blog Resmi</label>
                            <input id="blog_img" name="blog_img" type="file" class="form-control">
                        </div>


                        <div class="mb-5 xl:w-1/2">
                            <label class="label block mb-2" for="slug">Blog Başlığı</label>
                            <input id="blog_title" name="blog_title" type="text" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label class="label block mb-2" for="slug">Blog İçeriği</label>
                            <textarea id="blog_content" name="blog_content" class="form-control"></textarea>
                        </div>

                        <button type="button" onclick="core_form('{{route('blog-management-create-p')}}', 2, '{{route('blog-management')}}');" class="btn btn_primary uppercase">Blog Oluştur <i class="fa-solid fa-circle-notch fa-spin" style="display:none;margin-left:5px;"></i> </button>

                    </div>
                </div>
            </div>

        </form>

@endsection
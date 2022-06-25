@extends('syspanel.template')
@section('page_title', 'Ana Sayfa')
@section('content')

    <!-- Workspace -->
    <main class="workspace">

        <!-- Breadcrumb -->
        <section class="breadcrumb">
            <h1>Ana Sayfa</h1>
        </section>

        <div class="grid lg:grid-cols-2 gap-5">

            <!-- Summaries -->
            <div class="grid sm:grid-cols-{{(Auth::user()->role == 1) ? 3 : 2}} gap-5">
                <div style="cursor:pointer;" onclick="window.location='{{route('blog-management')}}';" class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-blog"></span>
                        <p class="mt-2">Toplam Blog</p>
                        <div class="text-primary mt-5 text-3xl leading-none">{{$reports->total_blogs}}</div>
                    </div>
                </div>

                @if(Auth::user()->role == 1)

                <div style="cursor:pointer;" onclick="window.location='{{route('category-management')}}';" class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-layer-group"></span>
                        <p class="mt-2">Toplam Kategori</p>
                        <div class="text-primary mt-5 text-3xl leading-none">{{$reports->total_category}}</div>
                    </div>
                </div>

                @endif

                <div class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                    <div>
                        <span class="text-primary text-5xl leading-none la la-cloud"></span>
                        <p class="mt-2">Toplam Görüntülenme</p>
                        <div class="text-primary mt-5 text-3xl leading-none">{{$total_visitors}}</div>
                    </div>
                </div>

            </div>

            <!-- Recent Posts -->
            <div class="card p-5 flex flex-col">
                <h3>Son Blog Yazıları</h3>

                @if(count($blogs) <= 0)

                    <p style="color:red;font-size:13px;">Henüz bir blog yazısı bulunmamakta.</p>

                @endif

                <table class="table table_list mt-3 w-full">
                    <thead>
                    <tr>
                        <th class="ltr:text-left rtl:text-right uppercase">Başlık</th>
                        <th class="w-px uppercase">Yazar</th>
                        <th class="w-px uppercase">Görüntülenme</th>
                        <th class="w-px uppercase" style="width: 12%;">Tarih</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($blogs as $p)

                        <tr onclick="window.location='{{route('blog-management-edit', [$p->id])}}';" style="cursor:pointer;">
                            <td>{{$p->blog_title}}</td>
                            <td class="text-center">{{$p->name}} {{$p->surname}}</td>
                            <td class="text-center">{{$p->total_visitors}}</td>
                            <td class="text-center">{{date("d-m-Y", strtotime($p->created_at))}}</td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
                <div class="mt-auto">
                    <a href="{{route('blog-management')}}" class="btn btn_primary mt-5">Tümünü Göster</a>
                </div>
            </div>

        </div>

@endsection
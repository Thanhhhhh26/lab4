@extends('layouts.app')

@section('title', $news->title)
@section('description', Str::limit($news->summary, 160))

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.category', $news->category_slug) }}">{{ $news->category_name }}</a></li>
                <li class="breadcrumb-item active">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-3">
    <div class="row">
        <!-- Nội dung chính -->
        <div class="col-lg-8">
            <article class="bg-white rounded-3 p-4 shadow-sm">
                <!-- Danh mục -->
                <a href="{{ route('news.category', $news->category_slug) }}"
                   class="badge text-decoration-none mb-3 px-3 py-2"
                   style="background:var(--primary);font-size:13px">{{ $news->category_name }}</a>

                <!-- Tiêu đề -->
                <h1 class="fw-bold mb-3" style="font-size:1.6rem;line-height:1.4;color:#1a1a1a">{{ $news->title }}</h1>

                <!-- Meta -->
                <div class="d-flex flex-wrap gap-3 text-muted mb-4 pb-3 border-bottom" style="font-size:13px">
                    @if($news->author_name)
                    <span><i class="bi bi-person me-1"></i>{{ $news->author_name }}</span>
                    @endif
                    <span><i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($news->created_at)->format('d/m/Y H:i') }}</span>
                    <span><i class="bi bi-eye me-1"></i>{{ number_format($news->views) }} lượt xem</span>
                    <!-- Chia sẻ -->
                    <div class="ms-auto d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                           target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size:12px">
                            <i class="bi bi-facebook me-1"></i>Chia sẻ
                        </a>
                    </div>
                </div>

                <!-- Tóm tắt -->
                @if($news->summary)
                <div class="alert alert-light border-start border-danger border-3 mb-4" style="font-size:15px;font-style:italic">
                    {{ $news->summary }}
                </div>
                @endif

                <!-- Ảnh đại diện -->
                <img src="{{ $news->image ?? 'https://picsum.photos/seed/'.$news->id.'/800/450' }}"
                     alt="{{ $news->title }}" class="news-detail-img">

                <!-- Nội dung -->
                <div class="news-content">
                    {!! $news->content !!}
                </div>

                <!-- Tags -->
                <div class="mt-4 pt-3 border-top">
                    <span class="text-muted me-2" style="font-size:13px"><i class="bi bi-tag me-1"></i>Chuyên mục:</span>
                    <a href="{{ route('news.category', $news->category_slug) }}"
                       class="badge text-decoration-none px-3 py-2"
                       style="background:#f0f0f0;color:#333;font-size:13px">{{ $news->category_name }}</a>
                </div>
            </article>

            <!-- Tin liên quan -->
            @if($relatedNews->count() > 0)
            <div class="mt-4">
                <h4 class="section-title"><i class="bi bi-link-45deg me-2"></i>Tin Liên Quan</h4>
                <div class="row g-3">
                    @foreach($relatedNews as $item)
                    <div class="col-sm-6">
                        <div class="news-card">
                            <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.($item->id+5).'/400/200' }}"
                                 alt="{{ $item->title }}">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="{{ route('news.show', $item->slug) }}">{{ Str::limit($item->title, 70) }}</a>
                                </h6>
                                <div class="card-meta">
                                    <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <h5 class="section-title"><i class="bi bi-fire me-2 text-danger"></i>Tin Nổi Bật</h5>
                @php
                    $sidebarNews = \Illuminate\Support\Facades\DB::table('news')
                        ->join('categories','news.category_id','=','categories.id')
                        ->where('news.status',1)
                        ->where('news.id','!=',$news->id)
                        ->select('news.*','categories.name as category_name','categories.slug as category_slug')
                        ->orderBy('news.views','desc')
                        ->limit(6)->get();
                @endphp
                @foreach($sidebarNews as $i => $item)
                <div class="popular-item">
                    <span class="fw-bold text-danger me-2" style="font-size:16px;min-width:20px">{{ $i+1 }}</span>
                    <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.($item->id+30).'/70/55' }}"
                         alt="{{ $item->title }}">
                    <div class="title">
                        <a href="{{ route('news.show', $item->slug) }}">{{ Str::limit($item->title, 55) }}</a>
                        <div class="text-muted mt-1" style="font-size:11px">
                            <i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

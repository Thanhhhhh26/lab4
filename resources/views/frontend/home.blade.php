@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Cột chính -->
        <div class="col-lg-8">

            <!-- Tin nổi bật -->
            @if($featuredNews->count() > 0)
            <div class="mb-4">
                <h2 class="section-title"><i class="bi bi-star-fill me-2 text-warning"></i>Tin Nổi Bật</h2>
                <div class="row g-3">
                    @foreach($featuredNews->take(1) as $item)
                    <div class="col-12">
                        <div class="featured-main">
                            <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.$item->id.'/800/420' }}"
                                 alt="{{ $item->title }}">
                            <div class="overlay">
                                <a href="{{ route('news.category', $item->category_slug) }}"
                                   class="badge bg-danger text-decoration-none mb-2">{{ $item->category_name }}</a>
                                <h2><a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a></h2>
                                <small class="text-white-50">
                                    <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    &nbsp;|&nbsp;<i class="bi bi-eye me-1"></i>{{ number_format($item->views) }} lượt xem
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @foreach($featuredNews->skip(1)->take(4) as $item)
                    <div class="col-sm-6">
                        <div class="news-card">
                            <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.$item->id.'/400/200' }}"
                                 alt="{{ $item->title }}">
                            <div class="card-body">
                                <a href="{{ route('news.category', $item->category_slug) }}" class="category-badge">{{ $item->category_name }}</a>
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

            <!-- Tin mới nhất -->
            <div class="mb-4">
                <h2 class="section-title"><i class="bi bi-lightning-fill me-2 text-primary"></i>Tin Mới Nhất</h2>
                <div class="row g-3">
                    @forelse($latestNews as $item)
                    <div class="col-sm-6 col-md-4">
                        <div class="news-card">
                            <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.($item->id+10).'/400/200' }}"
                                 alt="{{ $item->title }}">
                            <div class="card-body">
                                <a href="{{ route('news.category', $item->category_slug) }}" class="category-badge">{{ $item->category_name }}</a>
                                <h6 class="card-title">
                                    <a href="{{ route('news.show', $item->slug) }}">{{ Str::limit($item->title, 65) }}</a>
                                </h6>
                                <p class="text-muted" style="font-size:13px">{{ Str::limit($item->summary, 80) }}</p>
                                <div class="card-meta d-flex justify-content-between">
                                    <span><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                    <span><i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">Chưa có tin tức nào.</div>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">

            <!-- Tin xem nhiều -->
            <div class="sidebar-card">
                <h5 class="section-title"><i class="bi bi-fire me-2 text-danger"></i>Xem Nhiều Nhất</h5>
                @foreach($popularNews as $i => $item)
                <div class="popular-item">
                    <span class="fw-bold text-danger me-2" style="font-size:18px;min-width:20px">{{ $i+1 }}</span>
                    <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.($item->id+20).'/70/55' }}"
                         alt="{{ $item->title }}">
                    <div class="title">
                        <a href="{{ route('news.show', $item->slug) }}">{{ Str::limit($item->title, 60) }}</a>
                        <div class="text-muted mt-1" style="font-size:11px">
                            <i class="bi bi-eye me-1"></i>{{ number_format($item->views) }} lượt xem
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Danh mục -->
            <div class="sidebar-card">
                <h5 class="section-title"><i class="bi bi-grid me-2"></i>Danh Mục</h5>
                <ul class="list-unstyled mb-0">
                    @foreach($categories as $cat)
                    <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <a href="{{ route('news.category', $cat->slug) }}" class="text-decoration-none text-dark fw-500">
                            <i class="bi bi-chevron-right text-danger me-2"></i>{{ $cat->name }}
                        </a>
                        <span class="badge bg-secondary rounded-pill">{{ $cat->news_count }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection

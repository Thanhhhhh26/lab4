@extends('layouts.app')

@section('title', $keyword ? 'Tìm kiếm: '.$keyword : 'Tìm Kiếm')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Tìm kiếm</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <!-- Form tìm kiếm lớn -->
    <div class="bg-white rounded-3 shadow-sm p-4 mb-4">
        <h4 class="fw-bold mb-3"><i class="bi bi-search me-2 text-danger"></i>Tìm Kiếm Tin Tức</h4>
        <form action="{{ route('news.search') }}" method="GET">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" name="q"
                       placeholder="Nhập từ khóa tìm kiếm..."
                       value="{{ $keyword }}" autofocus>
                <button class="btn btn-danger px-4" type="submit">
                    <i class="bi bi-search me-2"></i>Tìm Kiếm
                </button>
            </div>
        </form>
    </div>

    @if($keyword)
    <div class="d-flex align-items-center mb-3">
        <h5 class="mb-0">
            Kết quả tìm kiếm cho: <span class="text-danger">"{{ $keyword }}"</span>
        </h5>
        @if($news instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <span class="ms-auto text-muted" style="font-size:14px">Tìm thấy {{ $news->total() }} kết quả</span>
        @endif
    </div>

    @if($news instanceof \Illuminate\Pagination\LengthAwarePaginator && $news->count() > 0)
        <div class="row g-3">
            @foreach($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="news-card">
                    <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.$item->id.'/400/200' }}"
                         alt="{{ $item->title }}">
                    <div class="card-body">
                        <a href="{{ route('news.category', $item->category_slug) }}" class="category-badge">{{ $item->category_name }}</a>
                        <h6 class="card-title">
                            <a href="{{ route('news.show', $item->slug) }}">{{ Str::limit($item->title, 70) }}</a>
                        </h6>
                        <p class="text-muted" style="font-size:13px">{{ Str::limit($item->summary, 90) }}</p>
                        <div class="card-meta d-flex justify-content-between">
                            <span><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            <span><i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $news->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-search text-muted" style="font-size:4rem"></i>
            <h5 class="mt-3 text-muted">Không tìm thấy kết quả nào</h5>
            <p class="text-muted">Thử tìm kiếm với từ khóa khác hoặc kiểm tra lại chính tả.</p>
            <a href="{{ route('home') }}" class="btn btn-danger mt-2">
                <i class="bi bi-house me-2"></i>Về Trang Chủ
            </a>
        </div>
    @endif
    @else
    <div class="text-center py-5">
        <i class="bi bi-search text-muted" style="font-size:4rem"></i>
        <h5 class="mt-3 text-muted">Nhập từ khóa để tìm kiếm tin tức</h5>
    </div>
    @endif
</div>
@endsection

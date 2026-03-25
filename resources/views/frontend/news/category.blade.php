@extends('layouts.app')

@section('title', $category->name)
@section('description', $category->description)

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-3">
    <!-- Tiêu đề danh mục -->
    <div class="d-flex align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1" style="font-size:1.5rem;color:var(--secondary)">
                <span class="border-bottom border-danger border-3 pb-1">{{ $category->name }}</span>
            </h1>
            @if($category->description)
            <p class="text-muted mb-0" style="font-size:14px">{{ $category->description }}</p>
            @endif
        </div>
        <span class="ms-auto badge bg-secondary fs-6">{{ $news->total() }} bài viết</span>
    </div>

    <div class="row">
        <div class="col-lg-8">
            @forelse($news as $item)
            <div class="bg-white rounded-3 shadow-sm mb-3 overflow-hidden">
                <div class="row g-0">
                    <div class="col-4">
                        <img src="{{ $item->image ?? 'https://picsum.photos/seed/'.$item->id.'/300/200' }}"
                             alt="{{ $item->title }}"
                             style="width:100%;height:130px;object-fit:cover">
                    </div>
                    <div class="col-8 p-3">
                        <h6 class="fw-bold mb-2" style="line-height:1.4">
                            <a href="{{ route('news.show', $item->slug) }}" class="text-dark text-decoration-none">
                                {{ Str::limit($item->title, 80) }}
                            </a>
                        </h6>
                        <p class="text-muted mb-2" style="font-size:13px">{{ Str::limit($item->summary, 100) }}</p>
                        <div class="d-flex gap-3 text-muted" style="font-size:12px">
                            <span><i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                            <span><i class="bi bi-eye me-1"></i>{{ number_format($item->views) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>Chưa có tin tức nào trong danh mục này.
            </div>
            @endforelse

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                {{ $news->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-card">
                <h5 class="section-title"><i class="bi bi-grid me-2"></i>Danh Mục Khác</h5>
                @php
                    $allCats = \Illuminate\Support\Facades\DB::table('categories')
                        ->where('status',1)->where('id','!=',$category->id)->get();
                @endphp
                <ul class="list-unstyled mb-0">
                    @foreach($allCats as $cat)
                    <li class="py-2 border-bottom">
                        <a href="{{ route('news.category', $cat->slug) }}" class="text-decoration-none text-dark">
                            <i class="bi bi-chevron-right text-danger me-2"></i>{{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

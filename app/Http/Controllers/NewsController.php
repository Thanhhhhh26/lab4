<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    // Chi tiết tin tức
    public function show($slug)
    {
        $news = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->leftJoin('users', 'news.user_id', '=', 'users.id')
            ->where('news.slug', $slug)
            ->where('news.status', 1)
            ->select(
                'news.*',
                'categories.name as category_name',
                'categories.slug as category_slug',
                'users.name as author_name'
            )
            ->first();

        if (!$news) {
            abort(404, 'Không tìm thấy bài viết');
        }

        // Tăng lượt xem
        DB::table('news')->where('id', $news->id)->increment('views');

        // Tin liên quan cùng danh mục
        $relatedNews = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.category_id', $news->category_id)
            ->where('news.id', '!=', $news->id)
            ->where('news.status', 1)
            ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->orderBy('news.created_at', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.news.show', compact('news', 'relatedNews'));
    }

    // Tin theo danh mục
    public function category($slug)
    {
        $category = DB::table('categories')
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (!$category) {
            abort(404, 'Không tìm thấy danh mục');
        }

        $news = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.category_id', $category->id)
            ->where('news.status', 1)
            ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->orderBy('news.created_at', 'desc')
            ->paginate(9);

        return view('frontend.news.category', compact('category', 'news'));
    }

    // Tìm kiếm
    public function search(Request $request)
    {
        $keyword = trim($request->get('q', ''));

        $news = collect();
        if ($keyword) {
            $news = DB::table('news')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->where('news.status', 1)
                ->where(function ($query) use ($keyword) {
                    $query->where('news.title', 'like', "%{$keyword}%")
                          ->orWhere('news.summary', 'like', "%{$keyword}%")
                          ->orWhere('news.content', 'like', "%{$keyword}%");
                })
                ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
                ->orderBy('news.created_at', 'desc')
                ->paginate(9)
                ->appends(['q' => $keyword]);
        }

        return view('frontend.news.search', compact('news', 'keyword'));
    }
}

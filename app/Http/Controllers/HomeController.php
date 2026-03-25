<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Tin nổi bật
        $featuredNews = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.status', 1)
            ->where('news.featured', 1)
            ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->orderBy('news.created_at', 'desc')
            ->limit(5)
            ->get();

        // Tin mới nhất
        $latestNews = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.status', 1)
            ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->orderBy('news.created_at', 'desc')
            ->limit(12)
            ->get();

        // Tin xem nhiều nhất
        $popularNews = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->where('news.status', 1)
            ->select('news.*', 'categories.name as category_name', 'categories.slug as category_slug')
            ->orderBy('news.views', 'desc')
            ->limit(5)
            ->get();

        // Danh mục có số tin
        $categories = DB::table('categories')
            ->leftJoin('news', function ($join) {
                $join->on('categories.id', '=', 'news.category_id')
                     ->where('news.status', '=', 1);
            })
            ->where('categories.status', 1)
            ->select('categories.*', DB::raw('COUNT(news.id) as news_count'))
            ->groupBy('categories.id', 'categories.name', 'categories.slug', 'categories.description', 'categories.status', 'categories.created_at', 'categories.updated_at')
            ->get();

        return view('frontend.home', compact('featuredNews', 'latestNews', 'popularNews', 'categories'));
    }
}

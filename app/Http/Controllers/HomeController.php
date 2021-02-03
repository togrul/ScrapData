<?php

namespace App\Http\Controllers;


use App\Jobs\ScrapDataJob;
use App\Models\Products;


class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function trendyol()
    {
        $data=Products::query()
            ->where('seller_id',Products::TRENDYOL)
            ->where('is_completed',1)
            ->paginate(20);

        return view('sellers.trendyol',compact('data'));
    }

    public function defacto()
    {
        $data=Products::query()
            ->where('seller_id',Products::DEFACTO)
            ->where('is_completed',1)
            ->paginate(20);

        return view('sellers.defacto',compact('data'));
    }

    public function sync()
    {
        ScrapDataJob::dispatch('');
        return back();
    }
}

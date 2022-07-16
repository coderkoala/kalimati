<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Articles as model;

/**
 * Class PageController.
 */
class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($pageSlug=null) {
        $appLocale = request()->query('lang', null);
        if ($appLocale) {
            app()->setLocale($appLocale);
        }
        $article = model::where('slug', $pageSlug)->where('status', 'published')->firstOrFail();
        return view('frontend.pages.page', compact('article'));

    }}

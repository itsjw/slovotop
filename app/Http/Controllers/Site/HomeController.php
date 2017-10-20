<?php
declare(strict_types=1);

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Iso;
use App\Models\Method;
use App\Models\Slide;
use App\Models\Text;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $standards = Iso::get();
        $slides = Slide::get();
        $advantages = Advantage::get();
        $methods = Method::orderBy('number')->get();
        $texts = Text::get()->toArray();
        $texts = !empty($texts) ? $texts[0] : [];
        return view('home', compact('standards', 'texts', 'slides', 'methods', 'advantages'));
    }
}

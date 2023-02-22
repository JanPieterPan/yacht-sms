<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::first();
        return view('dashboard.texts', compact('texts'));
    }

    public function store(Request $request)
    {
        $text = Text::first();
        if($text) $text->update($request->all()); else Text::create($request->all());
        return redirect()->back()->with('success', 'Content texts successfully updated.');
    }
}

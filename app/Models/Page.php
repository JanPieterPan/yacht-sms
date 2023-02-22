<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class)->orderBy('id', 'desc');
    }

    public function parentPage()
    {
        $parentPage = Page::find($this->parent);
        return $parentPage->title;
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'parent');
    }

    public function parents()
    {
        return $this->belongsTo(Page::class, 'parent');
    }
}

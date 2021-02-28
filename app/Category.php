<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        'section_id',
        'parent_id',
        'category_name',
        'category_image',
        'category_discount',
        'description',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    public function subcategories()
    {
        return $this->hasMany('App\Category', "parent_id", 'id')->where('status', 1);
    }

    public function section() {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function parent_category(){
        return $this->belongsTo('App\Category', "parent_id");
    }
}

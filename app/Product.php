<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        "category_id",
        "section_id",
        "product_name",
        "product_code",
        "product_color",
        "product_price",
        "product_discount",
        "product_weight",
        "product_video",
        "main_image",
        "description",
        "wash_care",
        "fabric",
        "pattern",
        "sleev",
        "fit",
        "occassion",
        "meta_title",
        "meta_description",
        "meta_keywords",
        "is_featured",
        "status",
    ];
}

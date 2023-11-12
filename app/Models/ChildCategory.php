<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}

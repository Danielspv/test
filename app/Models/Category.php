<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_category_id',
        'code',
        'title',
        'description'
    ];

    protected $with = [
        'parentCategory'
    ];

    //Añadiendo relación parent Category
    public function parentCategory(){
        return $this->belongsTo(ParentCategory::class);
    }
}

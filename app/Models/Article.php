<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title','slug', 'category_id', 'desc', 'img', 'status', 'views', 'publish_date'];

 // Set the title and automatically generate a slug
 public function setTitleAttribute($value)
 {
     $this->attributes['title'] = $value;
     $this->attributes['slug'] = Str::slug($value);
 }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}

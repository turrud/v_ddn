<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'slug', 'text', 'excerpt', 'image'];

    protected $searchableFields = ['*'];
}

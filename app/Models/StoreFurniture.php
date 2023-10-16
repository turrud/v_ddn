<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreFurniture extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'price', 'image', 'file'];

    protected $searchableFields = ['*'];

    protected $table = 'store_furnitures';
}

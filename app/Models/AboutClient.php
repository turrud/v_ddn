<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutClient extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'image'];

    protected $searchableFields = ['*'];

    protected $table = 'about_clients';
}

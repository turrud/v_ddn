<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutPeople extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'jabatan', 'text', 'image'];

    protected $searchableFields = ['*'];

    protected $table = 'about_people';
}

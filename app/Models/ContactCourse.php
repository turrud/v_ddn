<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactCourse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'university',
        'major',
        'select_one',
        'time',
        'image',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'contact_courses';
}

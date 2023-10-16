<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutAward extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'tanggal',
        'award1',
        'award2',
        'award3',
        'award4',
        'award5',
        'image',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'about_awards';
}

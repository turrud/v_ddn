<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutEvent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'tanggal', 'lokasi'];

    protected $searchableFields = ['*'];

    protected $table = 'about_events';
}

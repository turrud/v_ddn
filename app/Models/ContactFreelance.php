<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactFreelance extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'introduce', 'file'];

    protected $searchableFields = ['*'];

    protected $table = 'contact_freelances';
}

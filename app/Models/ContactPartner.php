<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactPartner extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'brand', 'bidang_bisnis'];

    protected $searchableFields = ['*'];

    protected $table = 'contact_partners';
}

<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactInvest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'instansi', 'image', 'file'];

    protected $searchableFields = ['*'];

    protected $table = 'contact_invests';
}

<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceVirtualOffice extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'progres', 'image'];

    protected $searchableFields = ['*'];

    protected $table = 'service_virtual_offices';
}

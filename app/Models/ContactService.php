<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactService extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'business_need',
        'name',
        'phone_number',
        'email',
        'company_name',
        'location',
        'luas',
        'project_value',
        'info',
        'rencana_meeting',
        'rencana_pembayaran',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'contact_services';

    protected $casts = [
        'rencana_meeting' => 'datetime',
        'rencana_pembayaran' => 'datetime',
    ];
}

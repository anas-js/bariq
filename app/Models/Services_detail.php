<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Services_Detail extends Model
{

    protected $table = 'services_detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
        'item_id',
        'service_id'
    ];


    // Relationships
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

}

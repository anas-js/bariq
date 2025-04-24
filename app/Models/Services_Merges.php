<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Services_Merges extends Model
{

    protected $table = 'services_merges';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
         'id',
        'updated_at',
        'created_at',
        //  'service_id',
        'item_id',
        // 'merge_with_service_id'
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

    public function merge_with(): BelongsTo
    {
        return $this->belongsTo(service::class,'merge_with_service_id');
    }
}

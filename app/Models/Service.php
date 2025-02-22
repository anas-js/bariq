<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at'
    ];


    // Relationships
    public function services_order(): HasMany
    {
        return $this->hasMany(Services_Order::class);
    }


    public function services_merges(): HasMany
    {
        return $this->hasMany(Services_Merges::class);
    }

    public function merge_with(): HasMany
    {
        return $this->hasMany(Services_Merges::class,'merge_with_service_id');
    }
}

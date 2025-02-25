<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
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
        // 'id',
        'updated_at',
        'created_at'
    ];

    // Relationships
    // public function services_merges(): HasMany
    // {
    //     return $this->hasMany(Services_Merges::class);
    // }


    // public function services_details(): HasMany
    // {
    //     return $this->hasMany(Services_Detail::class);
    // }

    // public function services_order(): HasMany
    // {
    //     return $this->hasMany(Services_Order::class);
    // }
}

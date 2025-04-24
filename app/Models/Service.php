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
        //  'id',
        'status',
        'updated_at',
        'created_at'
    ];


    // Relationships
    // public function services_order(): HasMany
    // {
    //     return $this->hasMany(Services_Order::class);
    // }

    public function service_details(): HasMany
    {
        return $this->hasMany(Services_Detail::class);
    }


    public function servicesMerges(): HasMany
    {
        return $this->hasMany(Services_Merges::class);
    }

    public function mergeWith(): HasMany
    {
        return $this->hasMany(Services_Merges::class,'merge_with_service_id');
    }

    // ----------------
    public function details($item_id)
    {
        return $this->service_details()->where('item_id',$item_id)->first();
    }

}

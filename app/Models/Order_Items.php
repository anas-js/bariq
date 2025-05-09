<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order_Items extends Model
{

    protected $table = 'order_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'amount',
        'quantity',
        'item_id',
        // 'service_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        // 'id',
        'updated_at',
        'created_at',
        'order_id',
        // 'service_id',
         'item_id'
    ];

    // Relationships
    public function itemServers(): HasMany
    {
        return $this->hasMany(Order_Item_Services::class,'order_item_id');
    }

    public function serviceAvailable(): HasMany
    {
        return $this->hasMany(Services_Detail::class,'item_id','item_id')->join('services', 'services_details.service_id', '=', 'services.id')->with(['service.servicesMerges','service.mergeWith'])->where('services.status',true);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}

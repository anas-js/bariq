<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order_Item_Services extends Model
{
    //
    protected $table = 'order_item_services';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'service_id'
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
        "order_item_id"
        // 'service_id',
    ];

    // Relationships
    public function item(): BelongsTo
    {
        return $this->belongsTo(Order_Items::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}

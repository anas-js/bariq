<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Laundry extends Model
{

    protected $table = 'laundrys';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'time_open',
        'time_close',
        'whatsapp_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];


    // Relationships
    public function admin(): HasMany
    {
        return $this->hasMany(Admin::class);
    }
}

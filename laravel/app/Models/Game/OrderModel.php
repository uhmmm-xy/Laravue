<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $statusText 
 */
class OrderModel extends Model
{
    protected $table = "game_order";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $hidden = [''];

    protected $fillable = [
        'shop_id',
        'amount',
        'channel_id',
        'channel_name',
        'channel_order_id',
        'order_id',
        'user_id',
        'server_id',
        'role_id',
        'status',
        'currency',
        'pay_amount',
        'exp'
    ];

    protected $casts = [
        "exp" => "array"
    ];
}

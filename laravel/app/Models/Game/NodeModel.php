<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\NodeModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|NodeModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NodeModel query()
 * @mixin \Eloquent
 */
class NodeModel extends Model
{
    use HasFactory;
    protected $table = "game_node";
    protected $primaryKey = "id";

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
        'mark', 'name', 'addr', 'updated', 'node_stop_time', 'port', 'id'
    ];

    protected $casts = [];
}

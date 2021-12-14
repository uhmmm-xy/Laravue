<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Game\MapModel
 *
 * @property string $mode_text
 * @method static \Illuminate\Database\Eloquent\Builder|MapModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MapModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MapModel query()
 * @mixin \Eloquent
 */
class MapModel extends Model
{
    use HasFactory;
    protected $table = "game_map";
    protected $primaryKey = "map_id";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const MODE_TEXT = [
        '正常',
        '变异'
    ];

    protected $hidden = [''];

    protected $fillable = [
        'map_id',
        'name',
        'created',
        'nodename',
        'mark',
        'mode',
    ];

    protected $casts = [];

    protected $appends = ['mode_text'];
 
    public function getModeTextAttribute()
    {
        return self::MODE_TEXT[$this->mode];
    }
}

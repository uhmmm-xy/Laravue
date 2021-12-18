<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Service\Observers\Games\NoticeObserver;
use DateTimeInterface;

/**
 * @property int $timestamp 创建时间戳
 */
class NoticeModel extends Model
{
    use HasFactory;
    protected $table = "game_notice";
    protected $primaryKey = "id";

    /**
     * 为 array / JSON 序列化准备日期格式
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const FILENAME   = 'notice';
    const FILETYPE   = '.json';

    protected $hidden = [''];

    protected $fillable = [
        'content', 'json_url', 'desc'
    ];

    protected $casts = [];

    protected $appends = ['timestamp'];

    public function getTimestampAttribute()
    {
        return $this->created_at->timestamp;
    }
}

<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\FileModel
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $name 文件名
 * @property string|null $url 文件地址
 * @property string|null $tag 文件标签
 * @property string|null $key 编号
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FileModel whereUrl($value)
 * @mixin \Eloquent
 */
class FileModel extends Model
{
    use HasFactory;

    protected $table = "exa_files";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "name", "url", "tag", "key"
    ];
}

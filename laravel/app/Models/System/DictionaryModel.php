<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\DictionaryModel
 *
 * @property int $id
 * @property \datetime|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $name 字典名（中）
 * @property string|null $type 字典名（英）
 * @property bool|null $status 状态
 * @property string|null $desc 描述
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\System\DictionaryDetailModel[] $sysDictionaryDetails
 * @property-read int|null $sys_dictionary_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DictionaryModel extends Model
{
    use HasFactory;
    protected $table = "sys_dictionaries";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "name", "type",
        "status", "desc"
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
    ];

    // 关联子表
    public function sysDictionaryDetails()
    {
        return $this->hasMany('App\Models\System\DictionaryDetailModel','sys_dictionary_id','id');
    }
}

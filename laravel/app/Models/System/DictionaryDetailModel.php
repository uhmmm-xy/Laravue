<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\DictionaryDetailModel
 *
 * @property int $id
 * @property \datetime|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $label 展示值
 * @property int|null $value 字典值
 * @property int|null $status 启用状态
 * @property int|null $sort 排序标记
 * @property int|null $sys_dictionary_id 关联标记
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereSysDictionaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DictionaryDetailModel whereValue($value)
 * @mixin \Eloquent
 */
class DictionaryDetailModel extends Model
{
    use HasFactory;
    protected $table = "sys_dictionary_details";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "label", "value",
        "status", "sort", "sys_dictionary_id"
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}

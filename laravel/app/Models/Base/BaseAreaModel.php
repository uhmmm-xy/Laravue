<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Base\BaseAreaModel
 *
 * @property int $id ID
 * @property int|null $parent_id 父id
 * @property string|null $shortname 简称
 * @property string|null $name 名称
 * @property string|null $merger_name 全称
 * @property int|null $level 层级 0 1 2 省市区县
 * @property string|null $pinyin 拼音
 * @property string|null $code 长途区号
 * @property string|null $zip_code 邮编
 * @property string|null $first 首字母
 * @property string|null $lng 经度
 * @property string|null $lat 纬度
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereMergerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereShortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseAreaModel whereZipCode($value)
 * @mixin \Eloquent
 */
class BaseAreaModel extends Model
{
    use HasFactory;

    protected $table = "base_area";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ["id","created_at","updated_at","deleted_at","parent_id","shortname","name","merger_name","level","pinyin","code","zip_code","first","lng","lat"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}

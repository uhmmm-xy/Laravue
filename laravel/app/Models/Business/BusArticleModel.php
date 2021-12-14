<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Business\BusArticleModel
 *
 * @property int $id
 * @property \datetime|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $title 文章标题
 * @property string|null $desc 文章描述
 * @property int|null $author 作者ID
 * @property string|null $authorName 作者名字
 * @property string|null $content 文章内容
 * @property string|null $tag 文章标签
 * @property string|null $tagNames 标签回显
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereTagNames($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusArticleModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BusArticleModel extends Model
{
    use HasFactory;

    protected $table = "bus_article";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ["id","created_at","updated_at","deleted_at","title","desc","author","content","tag"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}

<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\System\AuthorityModel
 *
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $authority_id 角色ID
 * @property string|null $authority_name 角色名
 * @property string|null $parent_id 父角色ID
 * @property array|null $menu_ids 菜单IDS
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereAuthorityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereAuthorityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereMenuIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthorityModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuthorityModel extends Model
{
    use HasFactory;
    protected $table = "sys_authorities";
    protected $primaryKey = "authority_id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "authority_id", "authority_name", "parent_id", "menu_ids"
    ];

    protected $casts = [
        'menu_ids' => 'array',
    ];
}

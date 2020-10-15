<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Menu\Laravel\Link;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Menu
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 * @property string $label
 * @property string $label_color
 * @property string|null $description
 * @property string|null $model
 * @property string|null $route
 * @property int $order
 * @property string|null $icon
 * @property string|null $icon_color
 * @property int $enabled
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read Collection|Menu[] $children
 * @property-read int|null $children_count
 * @property-read Menu|null $parent
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|Menu newModelQuery()
 * @method static Builder|Menu newQuery()
 * @method static Builder|Menu permission($permissions)
 * @method static Builder|Menu query()
 * @method static Builder|Menu role($roles, $guard = null)
 * @method static Builder|Menu whereCreatedAt($value)
 * @method static Builder|Menu whereDescription($value)
 * @method static Builder|Menu whereEnabled($value)
 * @method static Builder|Menu whereIcon($value)
 * @method static Builder|Menu whereId($value)
 * @method static Builder|Menu whereModel($value)
 * @method static Builder|Menu whereOrder($value)
 * @method static Builder|Menu whereParentId($value)
 * @method static Builder|Menu whereRoute($value)
 * @method static Builder|Menu whereTitle($value)
 * @method static Builder|Menu whereUpdatedAt($value)
 * @mixin Eloquent
 */

class Menu extends Model
{
    use HasRoles;

    protected $enumCasts = [
        // 'attribute_name' => Enum::class
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Show the application dashboard.
     *
     * @return \Spatie\Menu\Laravel\Menu
     */
    public static function getMenu()
    {
        return \Spatie\Menu\Laravel\Menu::new()
            ->add(Link::to('/', 'Home'))
            ->add(Link::to('/about', 'About'));
    }

    public function children() {
        return $this->hasMany('App\Menu','parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\Menu','parent_id','id');
    }

}

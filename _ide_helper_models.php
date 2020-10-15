<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Departamento
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property DepartamentoRegion|null $region
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Collection|Municipio[] $municipios
 * @property-read int|null $municipios_count
 * @method static Builder|Departamento newModelQuery()
 * @method static Builder|Departamento newQuery()
 * @method static Builder|Departamento query()
 * @method static Builder|Departamento whereCreatedAt($value)
 * @method static Builder|Departamento whereEstado($value)
 * @method static Builder|Departamento whereId($value)
 * @method static Builder|Departamento whereNombre($value)
 * @method static Builder|Departamento whereRegion($value)
 * @method static Builder|Departamento whereUpdatedAt($value)
 * @method static Builder|Departamento whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Departamento onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Departamento withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Departamento withoutTrashed()
 */
	class Departamento extends \Eloquent {}
}

namespace App{
/**
 * App\Empresa
 *
 * @property int $id
 * @property string $nombre
 * @property int $nit
 * @property int $municipio_id
 * @property string $direccion
 * @property int $telefono
 * @property string $correoElectronico
 * @property string $logo
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCorreoElectronico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereNit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereUpdatedAt($value)
 */
	class Empresa extends \Eloquent {}
}

namespace App{
/**
 * App\Menu
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $title
 * @property string|null $description
 * @property string|null $model
 * @property string|null $route
 * @property int $order
 * @property string|null $icon
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
	class Menu extends \Eloquent {}
}

namespace App{
/**
 * App\Municipio
 *
 * @mixin Eloquent
 * @property int $id
 * @property string $nombre
 * @property int $departamento_id
 * @property string|null $acortado
 * @property BasicStatus|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property mixed|null $deleted_at
 * @property-read Departamento $departamento
 * @method static Builder|Municipio newModelQuery()
 * @method static Builder|Municipio newQuery()
 * @method static Builder|Municipio query()
 * @method static Builder|Municipio whereAcortado($value)
 * @method static Builder|Municipio whereCreatedAt($value)
 * @method static Builder|Municipio whereDepartamento($value)
 * @method static Builder|Municipio whereEstado($value)
 * @method static Builder|Municipio whereId($value)
 * @method static Builder|Municipio whereNombre($value)
 * @method static Builder|Municipio whereUpdatedAt($value)
 * @method static Builder|Municipio whereDepartamentoId($value)
 * @method static Builder|Municipio whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Municipio onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Municipio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Municipio withoutTrashed()
 */
	class Municipio extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $tipo_documento
 * @property int $documento
 * @property int $telefono
 * @property string $rol
 * @property int $municipio_id
 * @property string $direccion
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMunicipioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}


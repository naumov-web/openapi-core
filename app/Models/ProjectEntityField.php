<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectEntityField
 * @package App\Models
 *
 * @property-read int $id
 * @property string $name
 * @property string $description
 * @property string $default_value
 * @property int $type_id
 * @property int $project_entity_id
 * @property bool $is_nullable
 * @property bool $is_primary_key
 */
class ProjectEntityField extends Model
{
    /**
     * Guarded fields list
     * @var array
     */
    protected $guarded = [];
}

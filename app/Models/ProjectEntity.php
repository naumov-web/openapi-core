<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectEntity
 * @package App\Models
 *
 * @property-read int $id
 * @property int $project_id
 * @property string $name
 */
class ProjectEntity extends Model
{
    /**
     * Guarded fields list
     * @var array
     */
    protected $guarded = [];
}

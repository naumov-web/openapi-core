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
 * @property string $description
 */
class ProjectEntity extends Model
{
    /**
     * Guarded fields list
     * @var array
     */
    protected $guarded = [];
}

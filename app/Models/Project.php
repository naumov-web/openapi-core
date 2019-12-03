<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App\Models
 *
 * @property-read int $id
 * @property string $name
 * @property int $format_id
 * @property string $description
 * @property string $key
 */
class Project extends Model
{
    /**
     * Guarded fields list
     * @var array
     */
    protected $guarded = [];

    /**
     * Get format name attribute
     *
     * @return string
     */
    public function getFormatNameAttribute(): string
    {
        $config = config('handbooks.formats');

        return $config[$this->format_id - 1]['name'];
    }

    /**
     * Get base url attribute
     *
     * @return string
     */
    public function getBaseUrlAttribute(): string
    {
        $template = config('app.entity_base_url_template');

        return str_replace('{{key}}', $this->key, $template);
    }
}

<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menu
 *
 * @package App\Models
 */
class Menu extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'icon', 'role_id'];

    /**
     * Get admin menu
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeAdmin($query)
    {
        return $query->where('role_id', 1)->get();
    }
}

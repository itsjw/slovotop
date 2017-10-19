<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MenuRole
 *
 * @package App\Models
 */
class MenuRole extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}

<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LastLogin
 *
 * @package App\Models
 */
class LastLogin extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id'];
}

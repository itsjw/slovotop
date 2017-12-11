<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TaskLog
 * @package App\Models
 */
class TaskLog extends Model
{
    /**
     * @var array
     */
    protected $dateFormat = ['date_end'];
}

<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StageTaskAccess
 *
 * @package App\Models
 */
class StageTaskAccess extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['field'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stage()
    {
        return $this->hasMany(TaskStage::class, 'id', 'stage_id');
    }
}

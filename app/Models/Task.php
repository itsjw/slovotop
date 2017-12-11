<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @package App\Models
 */
class Task extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(TaskStatus::class, 'id', 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stage()
    {
        return $this->hasOne(TaskStage::class, 'id', 'stage_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editor()
    {
        return $this->hasOne(User::class, 'id', 'editor_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subject()
    {
        return $this->hasOne(TaskSubject::class, 'id', 'subject_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

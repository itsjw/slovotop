<?php
declare(strict_types=1);

namespace App\Http\Resources\Comments;

use App\Http\Resources\Users\UserLittle;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class Comment
 * @package App\Http\Resources\Comments
 */
class Comment extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'body' => $this->body,
            'user' => new UserLittle($this->user),
        ];
    }
}

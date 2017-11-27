<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Subjects\Subject;
use App\Models\TaskSubject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SubjectController
 * @package App\Http\Controllers\Api
 */
class SubjectController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getSubjects(Request $request)
    {
        $subject = TaskSubject::query();

        if (isset($request->id)) {
            $subject->where('id', $request->id);
        }

        return Subject::collection($subject->get());
    }
}

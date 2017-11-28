<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Doc;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Docs\Doc as DocResource;

/**
 * Class DocController
 * @package App\Http\Controllers\Api
 */
class DocController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getDocs(Request $request)
    {
        $doc = Doc::query();

        if (isset($request->id)) {
            $doc->where('id', $request->id);
        }

        return DocResource::collection($doc->get());
    }
}

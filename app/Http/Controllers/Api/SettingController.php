<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Settings\General;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * Class SettingController
 * @package App\Http\Controllers\Api
 */
class SettingController extends Controller
{
    /**
     * @param Request $request
     *
     * @return General
     */
    public function getGeneralSetting(Request $request)
    {
        $setting = Setting::all()->mapWithKeys(function ($item) {
            return [$item['name'] => $item['value']];
        });

        return new General($setting);
    }
}
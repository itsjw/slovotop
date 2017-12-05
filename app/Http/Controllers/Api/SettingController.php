<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingSaveValidation;
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
     * @apiVersion    0.2.0
     * @apiGroup      Setting
     * @apiPermission auth,accessRoute:settings
     * @api           {post} getGeneralSetting getGeneralSetting
     * @apiName       getGeneralSetting
     * @apiSuccess {Array} data [name:value,...]
     *
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

    /**
     * @param GeneralSettingSaveValidation $request
     *
     * @return array|void
     */
    public function saveGeneralSetting(GeneralSettingSaveValidation $request)
    {
        foreach ($request->generals as $key => $val) {
            $setting = Setting::where('name', $key)->first();

            $setting->value = $val;
            $setting->save();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
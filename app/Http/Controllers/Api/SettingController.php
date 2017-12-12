<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralSettingSaveValidation;
use App\Http\Resources\Settings\General;
use App\Models\Setting;

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
     *
     * @return General
     */
    public function getGeneralSetting() :General
    {
        $setting = Setting::all()->mapWithKeys(function ($item) {
            return [$item['name'] => $item['value']];
        });

        return new General($setting);
    }

    /**
     * @apiVersion    0.2.0
     * @apiGroup      Setting
     * @apiPermission auth,accessRoute:settings
     * @api           {post} saveGeneralSetting saveGeneralSetting
     * @apiName       saveGeneralSetting
     * @apiParam {Array} generals [name:value]
     * @apiParamExample {json} Request-Example:
     * {generals {name:100,...}}
     * @apiSuccess {String} success trans('data.notifyOK')
     * @apiError {Array} errors errors{name:'error xxx',...}
     *
     * @param GeneralSettingSaveValidation $request
     *
     * @return array
     */
    public function saveGeneralSetting(GeneralSettingSaveValidation $request) :array
    {
        foreach ($request->generals as $key => $val) {
            $setting = Setting::where('name', $key)->first();

            $setting->value = $val;
            $setting->save();
        }

        return ['success' => trans('data.notifyOK')];
    }
}
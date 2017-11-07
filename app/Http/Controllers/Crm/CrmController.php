<?php
declare(strict_types=1);

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;

/**
 * Class CrmController
 *
 * @package App\Http\Controllers\Crm
 */
class CrmController extends Controller
{
    /**
     * Main admin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('crm.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        return view('crm.settings');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function roles()
    {
        return view('crm.roles');
    }

    /**
     * Users admin
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function users()
    {
        return view('crm.users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projects()
    {
        return view('crm.projects');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tasks()
    {
        return view('crm.tasks');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function docs()
    {
        return view('crm.docs');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function docEdit()
    {
        return view('crm.docEdit');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reports()
    {
        return view('crm.reports');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\DirectSposnor;
use App\Http\Controllers\Admin\AdminController;
use App\LeadershipBonus;
use App\MatchingBonus;
use App\Packages;
use App\Settings;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Response;

class PackageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function updatereferbonus(Request $request)
    {
        $package = DirectSposnor::find($request->pk);

        $variable = $request->name;

        $package->$variable = $request->value;

        if ($package->save()) {
            return Response::json(array('status' => 1));
        } else {
            return Response::json(array('status' => 0));
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use Barryvdh\Debugbar\Facade as DebugBar;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $settings = Settings::all()->first();
        Debugbar::info($settings);

        return view('settings', ["settings" => $settings]);
    }
    
     public function feeupdate()
    {

        $settings = Settings::all()->first();
        return view('feeupdate', ["feeamount" => $settings->feeprice, "feerm" => $settings->rmprice]);
    }
    
     public function storefee(Request $request)
    {
            $settings = Settings::all()->first();
            $settings->exists = true;
            $settings->title = $settings->title;
            $settings->description = $settings->description;
            $settings->logo = $settings->logo;
            $settings->favicon = $settings->favicon;
            $settings->gacode = $settings->gacode;
            $settings->feeprice = request('feeamount');
            $settings->rmprice = request('feerm');
            $settings->save();
        return view('feeupdate', ["feeamount" => $settings->feeprice, "feerm" => $settings->rmprice]);
    }
    public function store(Request $request)
    {
        Debugbar::info($request->has('fee'));
        if ($request->has('fee')) {
            $settings = Settings::all()->first();
            $settings->exists = true;
            $settings->title = $settings->title;
            $settings->description = $settings->description;
            $settings->logo = $settings->logo;
            $settings->favicon = $settings->favicon;
            $settings->gacode = $settings->gacode;
            $settings->feeprice = request('feeamount');
            $settings->save();
        return view('feeupdate', ["feeamount" => $settings->feeprice]);
        }
        else
        {
        Debugbar::info(request('site_title'));

        $settings = Settings::all()->first();
        $settings->exists = true;
        $settings->title = request('site_title');
        $settings->description = request('site_description');

        Debugbar::info($request->hasFile('site_logo'));
        if ($request->hasFile('site_logo')) {

        Debugbar::info($request->hasFile('site_logo'));
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $request->site_logo->store('blogassets', 'public');
            $settings->logo = $request->site_logo->hashName();
        }
        if ($request->hasFile('site_favicon')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $request->site_favicon->store('blogassets', 'public');
            $settings->favicon = $request->site_favicon->hashName();
        }
        $settings->gacode = request('google_analytics_code');
        Debugbar::info($settings);

        $settings->save();
        return view('settings', ["settings" => $settings]);
    }
    }
}

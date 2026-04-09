<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Homepagebanner;
use Barryvdh\Debugbar\Facade as DebugBar;
class CmshomeController extends Controller
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
        $dbBanner = Homepagebanner::all()->first();
        return view('cmshome', ["banner" => $dbBanner->file_path]);
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required',
        ]);

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->file->store('banner', 'public');

            // Store the record, using the new file hashname which will be it's new filename identity.
            $dbBanner = Homepagebanner::all()->first();
            Debugbar::info($dbBanner);

            $banner = new Homepagebanner();
            $banner->exists = true;
            $banner->id = $dbBanner['id'];
            $banner->name = $request->name;
            $banner->file_path = $request->file->hashName();
            $banner->save(); // Finally, save the record.
        }
      //  $banner = Homepagebanner::all();
            Debugbar::info($banner->file_path);


        return view('cmshome', ["banner" => $banner->file_path]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
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
        return view('home');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        $settings = Settings::firstOrFail();
        return view('settings')->with(['settings' => $settings]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Settings $settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_settings(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'calories_per_day'=>'required|numeric',
        ]);

        if ($validator->fails())
        {
            $error = $validator->messages();
            return Redirect::back()->with('validator', $error);
        }
        $setting = Settings::findOrFail($id);
        $setting->update($request->all());

        return Redirect::back()->with('success', 'Action performed with success');
    }



}

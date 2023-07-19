<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = AppSetting::query()->first();
        return view('app-settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AppSetting $appSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppSetting $appSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppSetting $appSetting)
    {
        $request->validate([
            'header_background' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        if ($request->file('header_background')) {
            $path = $request->file('header_background')->store('images', 'public');
            $appSetting->header_background = $path;
        }

        $appSetting->banner_ad_enable = $request->get("banner_ad_enable") ?? $appSetting->banner_ad_enable;
        $appSetting->header_title = $request->get("header_title") ?? $appSetting->header_title;
        $appSetting->banner_ad = $request->get("banner_ad") ?? $appSetting->banner_ad;
        $appSetting->banner_ad_detail = $request->get("banner_ad_detail") ? utf8_encode($request->get("banner_ad_detail")) : $appSetting->banner_ad_detail;
        $appSetting->header_categoory = $request->get("header_categoory") ?? $appSetting->header_categoory;
        $appSetting->header_hide_button = $request->get("header_hide_button") ?? $appSetting->header_hide_button;
        $appSetting->maintenance_mode = $request->get("maintenance_mode") ?? $appSetting->maintenance_mode;
        $appSetting->min_version = $request->get("min_version") ?? $appSetting->min_version;

        $appSetting->save();

        return redirect()->back()->with('success', 'Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppSetting $appSetting)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

/**
 * Class TradersPaymentController.
 */
class SettingsController
{
    public function getExecutiveSettings() {
        return view('backend.settings.executives');

    }

    public function getAPISettings() {
        return view('backend.settings.getTawkSettings');
    }

    public function getMarqueeSettings() {
        return view('backend.settings.marquee');
    }

    public function getURLSettings() {
        return view('backend.settings.siteLinks');
    }

    public function post(Request $request) {
        foreach($request->except('_token') as $key => $value) {
            if(empty($value)) {
                setting()->forget($key);
            }
            if(empty($value) && $value == setting()->get($key)) {
                continue;
            }
            setting()->set($key, $value);
        }
        setting()->save();
        return redirect()->back()->withFlashSuccess(__('Settings saved successfully'));
    }
}

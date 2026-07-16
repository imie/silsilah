<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        if (!is_system_admin(auth()->user())) {
            abort(403);
        }

        $religion = Setting::get('religion', 'islam');

        return view('settings.index', compact('religion'));
    }

    public function update(Request $request)
    {
        if (!is_system_admin(auth()->user())) {
            abort(403);
        }

        $request->validate([
            'religion' => 'required|in:islam,buddha,christian,other',
        ]);

        Setting::set('religion', $request->religion);

        return back()->with('success', __('app.settings_updated'));
    }
}

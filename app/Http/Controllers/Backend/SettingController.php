<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Models\EmailConfiguration;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use App\Traits\ImageUploadTrait;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class SettingController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $this->ensureThemeColumnsExist();

        $generalSettings = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();
        $emailSettings = EmailConfiguration::first();
        $logoSetting = LogoSetting::first();
        $pusherSetting = PusherSetting::first();
        return view('admin.setting.index', compact('generalSettings', 'emailSettings', 'logoSetting', 'pusherSetting'));
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
            'currency_icon' => ['required', 'max:200'],
        ]);

        app(GeneralSettingRepositoryInterface::class)->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                'contact_phone' => $request->contact_phone,
                'contact_address' => $request->contact_address,
                'map' => $request->map,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone
            ]
        );

        toastr('Updated successfully!', 'success', 'Success');

        return redirect()->back();
    }

    public function emailConfigSettingUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'host' => ['required', 'max:200'],
            'username' => ['required', 'max:200'],
            'password' => ['required', 'max:200'],
            'port' => ['required', 'max:200'],
            'encryption' => ['required', 'max:200'],
        ]);

         EmailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        toastr('Updates successfully!', 'success', 'success');
        return redirect()->back();
    }

    public function logoSettingUpdate(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'max:3000'],
            'favicon' => ['image', 'max:3000'],
        ]);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $request->old_logo);
        $favicon = $this->updateImage($request, 'favicon', 'uploads', $request->old_favicon);

       LogoSetting::updateOrCreate(
            ['id' => 1],
            [
                'logo' =>  (!empty($logoPath)) ? $logoPath : $request->old_logo,
                'favicon' => (!empty($favicon)) ? $favicon : $request->old_favicon
            ]
        );

        toastr('Updated successfully!', 'success', 'success');

        return redirect()->back();
    }

    /** Pusher settings update */
    function pusherSettingUpdate(Request $request) : RedirectResponse {
        $validatedData = $request->validate([
            'pusher_app_id' => ['required'],
            'pusher_key' => ['required'],
            'pusher_secret' => ['required'],
            'pusher_cluster' => ['required'],
        ]);

        PusherSetting::updateOrCreate(
            ['id' => 1],
            $validatedData
        );

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->back();
    }

    /** Theme settings update */
    public function themeSettingUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'theme_color' => ['required', 'string', 'max:50'],
            'header_bg_color' => ['required', 'string', 'max:50'],
            'header_text_color' => ['required', 'string', 'max:50'],
            'footer_bg_color' => ['required', 'string', 'max:50'],
            'footer_text_color' => ['required', 'string', 'max:50'],
            'footer_bottom_color' => ['required', 'string', 'max:50'],
            'button_color' => ['required', 'string', 'max:50'],
            'button_text_color' => ['required', 'string', 'max:50'],
            'button_hover_color' => ['required', 'string', 'max:50'],
        ]);

        $this->ensureThemeColumnsExist();

        app(GeneralSettingRepositoryInterface::class)->updateOrCreate(
            ['id' => 1],
            [
                'theme_color' => $request->theme_color,
                'header_bg_color' => $request->header_bg_color,
                'header_text_color' => $request->header_text_color,
                'footer_bg_color' => $request->footer_bg_color,
                'footer_text_color' => $request->footer_text_color,
                'footer_bottom_color' => $request->footer_bottom_color,
                'button_color' => $request->button_color,
                'button_text_color' => $request->button_text_color,
                'button_hover_color' => $request->button_hover_color,
            ]
        );

        toastr('Theme settings updated successfully!', 'success', 'Success');
        return redirect()->back();
    }

    protected function ensureThemeColumnsExist(): void
    {
        if (!Schema::hasTable('general_settings')) {
            return;
        }

        Schema::table('general_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('general_settings', 'theme_color')) {
                $table->string('theme_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'header_bg_color')) {
                $table->string('header_bg_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'header_text_color')) {
                $table->string('header_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'footer_bg_color')) {
                $table->string('footer_bg_color')->nullable()->default('#0b2c3d');
            }
            if (!Schema::hasColumn('general_settings', 'footer_text_color')) {
                $table->string('footer_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'footer_bottom_color')) {
                $table->string('footer_bottom_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'button_color')) {
                $table->string('button_color')->nullable()->default('#0088cc');
            }
            if (!Schema::hasColumn('general_settings', 'button_text_color')) {
                $table->string('button_text_color')->nullable()->default('#ffffff');
            }
            if (!Schema::hasColumn('general_settings', 'button_hover_color')) {
                $table->string('button_hover_color')->nullable()->default('#02527a');
            }
        });
    }
}

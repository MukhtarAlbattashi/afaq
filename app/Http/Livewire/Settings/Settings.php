<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Settings extends Component
{

    use AuthorizesRequests;

    public bool $active = false;
    public $app_name, $msg, $url, $version;
    protected $paginationTheme = 'bootstrap';
    protected array $rules = [
        'app_name' => 'required|min:5|max:200',
        'msg' => 'required|min:1|max:250',
        'url' => 'required',
        'version' => 'required',
        'active' => 'required',
    ];

    public function mount()
    {
        $this->authorize('isAdmin');
        $setting = Setting::query()->first();
        if ($setting != null) {
            $this->app_name = $setting->app_name;
            $this->msg = $setting->msg;
            $this->url = $setting->url;
            $this->version = $setting->version;
            $this->active = $setting->active;
        }
    }

    public function render()
    {
        return view('livewire.settings.settings')->extends('layouts.app')
            ->section('content');
    }

    public function save()
    {
        $this->validate();
        $setting = Setting::query()->first();
        if ($setting != null) {
            $setting->app_name = $this->app_name;
            $setting->msg = $this->msg;
            $setting->url = $this->url;
            $setting->version = $this->version;
            $setting->active = $this->active;
            $setting->save();
        } else {
            $setting = new Setting();
            $setting->app_name = $this->app_name;
            $setting->msg = $this->msg;
            $setting->url = $this->url;
            $setting->version = $this->version;
            $setting->active = $this->active;
            $setting->save();
        }
        session()->flash('success', 'Success!');
    }
}

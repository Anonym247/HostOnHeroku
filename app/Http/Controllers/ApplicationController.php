<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    public function settings()
    {
        $configuration = [
            'name' => env('APP_NAME'),
            'logo' => config('app.images.logo'),
            'background' => config('app.images.background')
        ];

        return view('settings', ['configuration']);
    }

    public function setConfiguration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'logo' => 'mimes:jpg,jpeg,png,gif',
            'background' => 'mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());

        $this->config_set('app_name', $request->get('app_name'), config('app.app_name'));
        if ($request->hasFile('logo')) {
            $path = '/uploads/' . $request->file('logo')->storeAs('images', $request->file('logo')->getClientOriginalName());
            $this->config_set('logo', $path, config('app.images.logo'));
        }
        if ($request->hasFile('background')) {
            $path = '/uploads/' . $request->file('background')->storeAs('images', $request->file('background')->getClientOriginalName());
            $this->config_set('background', $path, config('app.images.background'));
        }
        if ($request->filled('bg-color')) {
            $color = $request->get('bg-color') != '#000000'
                ? $request->get('bg-color')
                : '';
            $this->config_set('bg-color', $color, config('app.bg-color'));
        }
        return redirect(route('home'));
    }

    public function setConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'app_name' => 'required|string|regex:/^[a-zA-Z]+$/u',
            'logo' => 'mimes:jpg,jpeg,png,gif',
            'background' => 'mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator->errors());
        $data = null;
        $data[] = [
            'key' => 'app_name',
            'value' => $request->get('app_name') ?? config('global.app_name')
        ];
        if ($request->hasFile('logo')) {
            $path = '/uploads/' . $request->file('logo')->storeAs('images', $request->file('logo')->getClientOriginalName());
            $data[] = [
                'key' => 'logo',
                'value' => $path
            ];
        }
        else
            $data[] = [
                'key' => 'logo',
                'value' => config('global.logo')
            ];
        if ($request->hasFile('background')) {
            $path = '/uploads/' . $request->file('background')->storeAs('images', $request->file('background')->getClientOriginalName());
            $data[] = [
                'key' => 'background',
                'value' => $path
            ];
        }
        else
            $data[] = [
                'key' => 'background',
                'value' => config('global.background')
            ];
        if ($request->filled('bg-color')) {
            $color = $request->get('bg-color') != '#000000'
                ? $request->get('bg-color')
                : '';
            $data[] = [
                'key' => 'bg-color',
                'value' => $color
            ];
        }
        else
            $data[] = [
                'key' => 'bg-color',
                'value' => config('global.bg-color')
            ];
        Configuration::truncate();
        Configuration::insert($data);

        return redirect(route('settings'));
    }

}

<?php

namespace App\Http\Controllers\Backend\Settings;

use Illuminate\Http\Request;

class API
{
    /**
     * @param  string  $model
     * @return Model
     */
    private function getModel($model)
    {
        switch ($model) {
            case 'city':
                return new \App\Models\Backend\Settings\SettingsCity();
            case 'country':
                return new \App\Models\Backend\Settings\SettingsCountry();
            case 'airlines':
                //@todo add airlines reference.
                return new \App\Models\Backend\Settings\SettingsAirlines();
            default:
                return new \App\Models\Backend\Settings\SettingsCountry();
        }
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request, $model)
    {
        $this->user = auth()->user();
        $model = $this->getModel($model);

        if (strlen($request->q) < 2) {
            return response()->json(['status' => 400, 'error' => __('Query is too short'), 'items' => []], 400);
        }

        if ($this->user) {
            try {
                return response()->json([
                    'status' => 200,
                    'items' => $model->scopeSearch($model, $request->q)
                              ->get(['id as id', 'name AS text']),
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'error' => __('Server is currently unable to fulfill your request.'), 'items' => []], 500);
            }
        } else {
            return response()->json(['status' => 403, 'error' => __('Insufficient Permissions'), 'items' => []], 403);
        }
    }
}

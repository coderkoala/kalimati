<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class KoalaHttpController. Does basic CRUD shit for you, just initialize the values in the corresponding derived classes.
 */
trait KoalaHttpController
{
    /**
     * Boot up the create validation and shove it to a private attribute.
     */
    private function bootValidationRules()
    {
        $this->validationRules = [];
        foreach ($this->fieldData as $key => $value) {
            if (isset($value['validation'])) {
                $this->validationRules[$key] = $value['validation'];
            }
        }
    }

    /**
     * Boot up the update validation and shove it to a private attribute.
     */
    private function bootUpdateValidation()
    {
        $this->validationRules = [];
        foreach ($this->fieldData as $key => $value) {
            if (isset($value['onUpdate'])) {
                $this->validationRules[$key] = $value['onUpdate'];
            }
        }
    }

    /*
    * Mayday mayday, Houston we have a problem in our hands!
    */
    private function bail()
    {
        if (empty($route) || ! $route) {
            $route = $this->routes['index'];
        }

        return redirect()->route($route)->withFlashDanger(__('kalimati.unauthorized', ['resource' => $this->resourceName]));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if ($this->user->can($this->permissions['read'])) {
            return view($this->views['index']);
        } else {
            return $this->bail();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $arrayFilter = ['all'])
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        $fieldsForShow = $this->array_wrangle(['hidden' => true, 'disabled' => true, 'render' => false], ['all']);
        $fieldsForShow = $this->array_wrangle(['hidden' => false, 'disabled' => false, 'render' => true], $arrayFilter);
        if ($this->user->can($this->permissions['create'])) {
            return view($this->views['create'], [
                'fields' => $fieldsForShow,
            ]);
        } else {
            return $this->bail();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $arrayTimestamps = ['created_at', 'updated_at'])
    {
        $validationObject = Validator::make($request->all(), $this->validationRules);
        if ($validationObject->fails()) {
            $errorstring = '';
            $error = $this->array_flatten(array_values($validationObject->getMessageBag()->toArray()));
            foreach ($error as $key => $value) {
                $errorstring .= $value.' ';
            }

            return redirect()->route($this->routes['create'])->withFlashDanger($errorstring)->withInput();
        } else {
            $this->user = Auth::user();
            if (! $this->user) {
                return $this->bail();
            }

            if ($this->user->can($this->permissions['create'])) {
                try {
                    // Add in created_at and updated_at to the request.
                    foreach ($arrayTimestamps as $timestampTuple) {
                        $request->merge([$timestampTuple => date('Y-m-d H:i:s')]);
                    }
                    $this->model->insert($request->except('_token'));

                    return redirect()->route($this->routes['index'])->withFlashSuccess(__('kalimati.created', ['resource' => $this->resourceName]));
                } catch (\Exception $e) {
                    return redirect()->route($this->routes['create'])->withFlashDanger(__('kalimati.create_failed', ['resource' => $this->resourceName]))->withInput();
                }
            } else {
                return $this->bail();
            }
        }
    }

    /**
     * Wrangle a spepcific array's key value to a given value.
     *
     * @return array
     */
    private function array_wrangle($parameters, $fields, $switch = null)
    {
        $wrangledArray = [];
        $source = $this->fieldData;
        array_walk($source, function ($tuple, $index) use (&$parameters, &$wrangledArray, &$fields, &$switch) {
            if (in_array('all', $fields) || in_array($index, $fields)) {
                foreach ($parameters as $parameterKey => $parameterValue) {
                    $tuple[$parameterKey] = $parameterValue;

                    if (null !== $switch) {
                        $tuple[$parameterKey] = $switch;
                    }
                }
                $wrangledArray[$index] = $tuple;
            }
        });

        return $wrangledArray;
    }

    /**
     * Display the specified resource.
     *
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if (method_exists($this->model, 'initializeSoftDeletes')) {
            $this->model = $this->model::withTrashed()->findOrFail($id)->toArray();
        } else {
            $this->model = $this->model::findOrFail($id)->toArray();
        }
        $fieldsForShow = $this->array_wrangle(['hidden' => false, 'disabled' => true, 'render' => true], ['all']);

        $this->model['created_at'] = $this->model['created_at'] ? date('Y-m-d', strtotime($this->model['created_at'])) : null;
        $this->model['updated_at'] = $this->model['updated_at'] ? date('Y-m-d', strtotime($this->model['updated_at'])) : null;

        if ($this->user->can($this->permissions['read'])) {
            return view($this->views['show'], [
                'fields' => $fieldsForShow,
                'data' => $this->model,
            ]);
        } else {
            return $this->bail();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $arrayFilter = ['all'])
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if (method_exists($this->model, 'initializeSoftDeletes')) {
            $this->model = $this->model::withTrashed()->findOrFail($id)->toArray();
        } else {
            $this->model = $this->model::findOrFail($id)->toArray();
        }
        $fieldsForShow = $this->array_wrangle(['hidden' => true, 'disabled' => true, 'render' => false], ['all']);
        $fieldsForShow = $this->array_wrangle(['hidden' => false, 'disabled' => false, 'render' => true], $arrayFilter);

        if ($this->user->can($this->permissions['read'])) {
            return view($this->views['edit'], [
                'fields' => $fieldsForShow,
                'data' => $this->model,
            ]);
        } else {
            return $this->bail();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $arrayFilter = [])
    {
        $this->bootUpdateValidation();
        $validationObject = Validator::make($request->all(), $this->validationRules);
        if ($validationObject->fails()) {
            $errorstring = '';
            $error = $this->array_flatten(array_values($validationObject->getMessageBag()->toArray()));
            foreach ($error as $key => $value) {
                $errorstring .= $value.' ';
            }

            return redirect()->route($this->routes['edit'], $id)->withFlashDanger($errorstring)->withInput();
        } else {
            $this->user = Auth::user();
            if (! $this->user) {
                return $this->bail();
            }

            if ($this->user->can($this->permissions['update'])) {
                try {
                    if (method_exists($this->model, 'initializeSoftDeletes')) {
                        $this->model = $this->model->withTrashed()->where('id', $id)->firstOrFail();
                    } else {
                        $this->model = $this->model->where('id', $id)->firstOrFail();
                    }
                    $this->model->update($request->only($arrayFilter));
                    $this->model->save();

                    return redirect()->route($this->routes['index'], $id)->withFlashSuccess(__('kalimati.updated', ['resource' => $this->resourceName]));
                } catch (\Exception $e) {
                    return redirect()->route($this->routes['edit'], $id)->withFlashDanger(__('kalimati.update_failed', ['resource' => $this->resourceName]))->withInput();
                }
            } else {
                return $this->bail();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        // Check if $this->model has soft delete enabled.
        if (method_exists($this->model, 'initializeSoftDeletes')) {
            $this->model = $this->model::withTrashed()->findOrFail($id);
        } else {
            $this->model = $this->model::findOrFail($id);
        }
        $verb = 'deleted';

        if ($this->user->can($this->permissions['deleteX'])) {
            try {
                if (method_exists($this->model, 'initializeSoftDeletes') && $this->model->trashed()) {
                    $this->model->restore();
                    $verb = 'restored';
                } else {
                    $this->model->delete();
                }

                return redirect()->route($this->routes['index'])->withFlashSuccess(__('kalimati.deleted', ['resource' => $this->resourceName]));
            } catch (\Exception $e) {
                return redirect()->route($this->routes['index'])->withFlashDanger(__('kalimati.delete_failed', ['resource' => $this->resourceName]));
            }
        } else {
            return $this->bail();
        }
    }

    /**
     * Convert a multi-dimensional array into a single-dimensional array.
     *
     * @author Sean Cannon, LitmusBox.com | seanc@litmusbox.com
     *
     * @param  array  $array  The multi-dimensional array.
     * @return array
     */
    private function array_flatten($array)
    {
        if (! is_array($array)) {
            return false;
        }
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, $this->array_flatten($value));
            } else {
                $result = array_merge($result, [$key => $value]);
            }
        }

        return $result;
    }
}

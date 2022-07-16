<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\ArrivalLog as model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * Class ArrivalLogController.
 */
class ArrivalLogController
{
    /**
     * Properties for dep injection.
     */
    private $model;
    private $fieldData;

    // Stored views, so functors can pivot out to the right view.
    private $views = [
        'index' => 'backend.arrival.index',
        'create' => 'backend.arrival.create',
        'edit' => 'backend.arrival.edit',
        'show' => 'backend.arrival.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.arrival',
        'create' => 'admin.arrival.create',
        'read' => 'admin.arrival.view',
        'update' => 'admin.arrival.update',
        'deleteX' => 'admin.arrival.deactivate',
        'delete' => 'admin.arrival.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.arrival.index',
        'create' => 'admin.arrival.create',
        'edit' => 'admin.arrival.edit',
        'show' => 'admin.arrival.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Arrival Log';

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

    // Constructor for dependency injection.
    // Aside from users, this is the only place where you should inject your models.
    public function __construct()
    {
        $this->model = new model();
        $this->fieldData = $this->model->getFieldData();
        $this->bootValidationRules();
    }

    /*
    * Mayday mayday, Houston we have a problem in our hands!
    */
    private function bail($route = null)
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

        if ($this->user->can($this->permissions['create'])) {
            return view($this->views['create']);
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
    public function store(Request $request)
    {
        $this->validationRules = [
            'file' => 'required|url',
            'entry_date' => 'required|date',
        ];
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

            if (! file_exists($filePath = public_path(str_replace(env('APP_URL'), '', $request->file)))) {
                return redirect()->route($this->routes['create'])->withFlashDanger(__('kalimati.file_access'))->withInput();
            } else {
                if ($this->user->can($this->permissions['create'])) {
                    try {
                        return $this->parseFile($request, $filePath);
                    } catch (\Exception $e) {
                        return redirect()->route($this->routes['create'])->withFlashDanger(__('kalimati.create_failed', ['resource' => $this->resourceName]))->withInput();
                    }
                } else {
                    return $this->bail();
                }
            }
        }
    }

    /**
     * Dump the data values from spreadsheet to the database.
     *
     * @param  Request  $request
     * @param  string  $data
     */
    private function commitToDatabase(Request $request, $data)
    {
        $insertData = [];
        $timestamp = date('Y-m-d H:i:s');
        $commodities = \App\Models\Backend\CommoditiesArrival::withTrashed()->get()->pluck('commodity_id')->toArray();

        \DB::beginTransaction();
        array_shift($data);

        foreach ($data as $tuple) {
            if (! in_array($tuple[0], $commodities)) {
                try {
                    $newCommodity = new \App\Models\Backend\CommoditiesArrival();
                    $newCommodity->commodity_id = $tuple[0];
                    $newCommodity->commodity_en = 'CODE :'.$tuple[0];
                    $newCommodity->commodity_np = 'अज्ञात :'.$tuple[0];
                    $newCommodity->unit_en = 'N/A';
                    $newCommodity->unit_np = 'N/A';
                    $newCommodity->created_by = $this->user->id;
                    $newCommodity->created_at = $timestamp;
                    $newCommodity->updated_at = $timestamp;
                    $newCommodity->save();
                } catch (\Exception $e) {
                    \DB::rollback();

                    return redirect()->route($this->routes['create'])->withFlashDanger(
                        __('kalimati.fatal_commodity', ['id' => $tuple[0]])
                    )->withInput();
                }
            }

            try {
                $insertData[] = [
                    'commodity_id' => $tuple[0],
                    'quantity' => (float) $tuple[1],
                    'entry_date' => $request->entry_date,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            } catch (\Exception $e) {
                continue;
            }
        }
        model::where('entry_date', $request->entry_date)->delete();

        try {
            model::insert($insertData);
            \DB::commit();

            return redirect()->route($this->routes['index'])->withFlashSuccess(__('kalimati.created', ['resource' => $this->resourceName]));
        } catch (\Exception $e) {
            \DB::rollback();

            return redirect()->route($this->routes['create'])->withFlashDanger(
                __('kalimati.fatal_bulkdispatch')
            )->withInput();
        }
    }

    /**
     * Parse the given xls/xlsx file using PHPOpffice, and dump the values into the database.
     *
     * @param  Request  $request
     * @param  string  $filePath
     */
    private function parseFile(Request $request, $filePath)
    {
        $reader = null;
        switch (strtolower(pathinfo($filePath, PATHINFO_EXTENSION))) {
            case 'xls':
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
                $reader->setReadDataOnly(true);
                break;

            default:
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                $reader->setReadDataOnly(true);
        }

        if (! $reader) {
            return redirect()
            ->route($this->routes['create'])
            ->withFlashDanger(__('kalimati.fatal_spoofed_file'))
            ->withInput();
        } else {
            $spreadsheet = $reader->load($filePath);
            $allSheets = $spreadsheet->getAllSheets();

            foreach ($allSheets as $sheet) {
                $sheetData = $sheet->toArray();
                if ($sheetData !== [[0 => null]]) {
                    return $this->commitToDatabase($request, $sheetData);
                } else {
                    return redirect()
                    ->route($this->routes['create'])
                    ->withFlashDanger(__('kalimati.fatal_empty_sheet'))
                    ->withInput();
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function show($entry_date)
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if ($this->user->can($this->permissions['read'])) {
            return view($this->views['show'], [
                'entry_date' => $entry_date,
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
    public function edit(Request $request, $entry_date)
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if ($this->user->can($this->permissions['read'])) {
            return view($this->views['edit'],
            [
                'id' => $entry_date,
                'commodities'=> \App\Models\Backend\CommoditiesArrival::select('commodity_id', \DB::raw('commodity_'.app()->getLocale()).' as commodity')
                ->get(),
                'data' => $this->model
                ->select([
                    'id',
                    'commodity_id',
                    'quantity',
                ])
                ->where('entry_date', $entry_date)
                ->get(),
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
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            $errorstring = '';
            $error = $this->array_flatten(array_values($validation->getMessageBag()->toArray()));
            foreach ($error as $key => $value) {
                $errorstring .= __($value).' ';
            }

            return response()->json([
                'status' => 'error',
                'message' => $errorstring,
            ], 403);
        }

        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        if ($this->user->can($this->permissions['update'])) {
            try {
                $this->model->find($id)->update($request->only('quantity'));

                return response()->json([
                    'status' => 'success',
                    'message' => __('kalimati.updated', ['resource' => $this->resourceName]),
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('kalimati.update_failed', ['resource' => $this->resourceName]),
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => __('kalimati.unauthorized', ['resource' => $this->resourceName]),
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $entry_date)
    {
        $this->user = Auth::user();
        if (! $this->user) {
            return $this->bail();
        }

        $this->model = $this->model->where('entry_date', $entry_date);

        $verb = 'deleted';
        if ($this->user->can($this->permissions['delete'])) {
            try {
                $this->model->delete();

                return redirect()->route($this->routes['index'])->withFlashSuccess(__('kalimati.deleted', ['resource' => $this->resourceName]));
            } catch (\Exception $e) {
                return redirect()->route($this->routes['index'])->withFlashDanger(__('kalimati.delete_failed', ['resource' => $this->resourceName]));
            }
        } else {
            return $this->bail();
        }
    }
}

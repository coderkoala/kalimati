<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use App\Models\Backend\TraderDues as model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class TradersDueController.
 */
class TradersDueController
{
    use HttpController {
        store as baseStore;
        update as baseUpdate;
        edit as baseEdit;
    }

    /**
     * Properties for dep injection.
     */
    private $model;
    private $fieldData;

    // Stored views, so functors can pivot out to the right view.
    private $views = [
        'index' => 'backend.traderdues.index',
        'create' => 'backend.traderdues.create',
        'edit' => 'backend.traderdues.edit',
        'show' => 'backend.traderdues.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.traderdues',
        'create' => 'admin.traderdues.create',
        'read' => 'admin.traderdues.view',
        'update' => 'admin.traderdues.update',
        'deleteX' => 'admin.traderdues.deactivate',
        'delete' => 'admin.traderdues.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.traderdues.index',
        'create' => 'admin.traderdues.create',
        'edit' => 'admin.traderdues.edit',
        'show' => 'admin.traderdues.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Trader Dues';

    // Constructor for dependency injection.
    // Aside from users, this is the only place where you should inject your models.
    public function __construct()
    {
        $this->model = new model();
        $this->fieldData = $this->model->getFieldData();
        $this->bootValidationRules();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            return $this->baseStore($request);
        } catch (\Exception $e) {
            $this->forbiddenMessage = __($e->getMessage());

            return $this->bail();
        }
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->baseUpdate($request, $id, [
            'trader_id',
            'tradername',
            'shop_id',
            'due_date',
            'monthly_rent',
            'late_fee',
            'other_amount',
            'adjustment',
            'total_amount',
        ]);
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return $this->baseEdit($request, $id, [
            'trader_id',
            'tradername',
            'shop_id',
            'due_date',
            'monthly_rent',
            'late_fee',
            'other_amount',
            'adjustment',
            'total_amount',
        ]);
    }

    /**
     * Upload trader dues data.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $rules = [
            'file' => 'required|url',
        ];
        $validationObject = Validator::make($request->all(), $rules);
        if ($validationObject->fails()) {
            $errorstring = '';
            $error = $this->array_flatten(array_values($validationObject->getMessageBag()->toArray()));
            foreach ($error as $key => $value) {
                $errorstring .= $value.' ';
            }

            return redirect()->route($this->routes['index'])->withFlashDanger($errorstring)->withInput();
        } else {
            $this->user = \Auth::user();
            if (! $this->user) {
                return $this->bail();
            }

            if (! file_exists($filePath = public_path(str_replace(env('APP_URL'), '', $request->file)))) {
                return redirect()->route($this->routes['index'])->withFlashDanger(__('kalimati.file_access'))->withInput();
            } else {
                if ($this->user->can('admin.traderdues')) {
                    try {
                        return $this->parseFile($request, $filePath);
                    } catch (\Exception $e) {
                        return redirect()->route($this->routes['index'])->withFlashDanger(__('kalimati.create_failed', ['resource' => $this->resourceName]))->withInput();
                    }
                } else {
                    return $this->bail();
                }
            }
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
            ->route($this->routes['index'])
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
     * Dump the data values from spreadsheet to the database.
     *
     * @param  Request  $request
     * @param  string  $data
     */
    private function commitToDatabase(Request $request, $data)
    {
        $insertData = [];
        $timestamp = date('Y-m-d H:i:s');

        array_shift($data);

        foreach ($data as $tuple) {
            try {
                $tuple[4] = ($tuple[4] && $tuple[4] > 9999999.99) ? 9999999.99 : $tuple[4];
                $tuple[5] = ($tuple[5] && $tuple[5] > 9999999.99) ? 9999999.99 : $tuple[5];
                $tuple[6] = ($tuple[6] && $tuple[6] > 9999999.99) ? 9999999.99 : $tuple[6];
                $tuple[7] = ($tuple[7] && $tuple[7] > 9999999.99) ? 9999999.99 : $tuple[7];
                $tuple[8] = ($tuple[8] && $tuple[8] > 9999999.99) ? 9999999.99 : $tuple[8];

                if ($tuple[0] && $tuple[1] && $tuple[2]) {
                    $insertData[] = [
                        'trader_id' => $tuple[0],
                        'tradername' => $tuple[1],
                        'shop_id' => $tuple[2],
                        'due_date' => date('Y-m-d'),
                        'monthly_rent' => $tuple[4],
                        'late_fee' => $tuple[5],
                        'other_amount' => $tuple[6],
                        'adjustment' => $tuple[7],
                        'total_amount' => $tuple[8],
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        \DB::beginTransaction();

        try {
            \DB::table('traders_due')->delete();
            $this->model::insert($insertData);
        } catch (\Exception $e) {
            dd($insertData);
            \DB::rollback();

            return redirect()->route($this->routes['index'])->withFlashDanger(
                __('kalimati.fatal_bulkdispatch').' '.__('Code').' : '.$e->getCode()
            )->withInput();
        }

        \DB::commit();

        return redirect()->route($this->routes['index'])->withFlashSuccess(__('kalimati.created', ['resource' => $this->resourceName]));
    }
}

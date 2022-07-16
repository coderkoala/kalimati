<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Commodities as model;
use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use Illuminate\Http\Request;

/**
 * Class CommoditiesController.
 */
class CommoditiesController
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
        'index' => 'backend.commodities.index',
        'create' => 'backend.commodities.create',
        'edit' => 'backend.commodities.edit',
        'show' => 'backend.commodities.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.commodities',
        'create' => 'admin.commodities.create',
        'read' => 'admin.commodities.view',
        'update' => 'admin.commodities.update',
        'deleteX' => 'admin.commodities.deactivate',
        'delete' => 'admin.commodities.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.commodities.index',
        'create' => 'admin.commodities.create',
        'edit' => 'admin.commodities.edit',
        'show' => 'admin.commodities.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Commodity';

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
            // Get current userid .
            $created_by = \Auth::user()->id;
            $request->request->add([
                'created_by' => $created_by,
            ]);
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
            'commodity_id',
            'commodity_en',
            'commodity_np',
            'unit_en',
            'unit_np',
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
            'commodity_id',
            'commodity_en',
            'commodity_np',
            'unit_en',
            'unit_np',
        ]);
    }
}

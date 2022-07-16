<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use App\Models\Backend\CommoditiesArrival as model;
use Illuminate\Http\Request;

/**
 * Class CommoditiesArrivalController.
 */
class CommoditiesArrivalController
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
        'index' => 'backend.commodities_arrival.index',
        'create' => 'backend.commodities_arrival.create',
        'edit' => 'backend.commodities_arrival.edit',
        'show' => 'backend.commodities_arrival.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.commodities_arrival',
        'create' => 'admin.commodities_arrival.create',
        'read' => 'admin.commodities_arrival.view',
        'update' => 'admin.commodities_arrival.update',
        'deleteX' => 'admin.commodities_arrival.deactivate',
        'delete' => 'admin.commodities_arrival.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.commodities_arrival.index',
        'create' => 'admin.commodities_arrival.create',
        'edit' => 'admin.commodities_arrival.edit',
        'show' => 'admin.commodities_arrival.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Arrival Commodity';

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

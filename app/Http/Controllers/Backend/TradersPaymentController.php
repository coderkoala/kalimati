<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\TraderDuesPayment as model;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use Illuminate\Http\Request;

/**
 * Class TradersPaymentController.
 */
class TradersPaymentController
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
        'index' => 'backend.traderduespayment.index',
        'create' => 'backend.traderduespayment.index',
        'edit' => 'backend.traderdues.show',
        'show' => 'backend.traderduespayment.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.traderduespayment',
        'create' => 'admin.traderduespayment.create',
        'read' => 'admin.traderduespayment.view',
        'update' => 'admin.traderduespayment.update',
        'deleteX' => 'admin.traderduespayment.deactivate',
        'delete' => 'admin.traderduespayment.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.traderduespayment.index',
        'create' => 'admin.traderduespayment.index',
        'edit' => 'admin.traderduespayment.edit',
        'show' => 'admin.traderduespayment.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Transaction Details';

    // Constructor for dependency injection.
    // Aside from users, this is the only place where you should inject your models.
    public function __construct()
    {
        $this->model = new model();
        $this->fieldData = $this->model->getFieldData();
        $this->bootValidationRules();
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->bail();
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->bail();
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->bail();
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->model = new \App\Models\Backend\TraderDuesHistory();
        $this->fieldData = \App\Models\Backend\TraderDues::getFieldData();
        $this->user = \Auth::user();
        if (!$this->user) {
            return $this->bail();
        }

        if (method_exists($this->model, 'initializeSoftDeletes')) {
            $this->model = $this->model::withTrashed()->findOrFail($id)->toArray();
        } else {
            $this->model = $this->model::findOrFail($id)->toArray();
        }
        $fieldsForShow = $this->array_wrangle(['hidden' => true, 'disabled' => true, 'render' => false], ['all']);
        $fieldsForShow = $this->array_wrangle(['hidden' => false, 'disabled' => true, 'render' => true], [
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
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->bail();
    }
}

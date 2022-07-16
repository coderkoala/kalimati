<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Classes\KoalaCipherEncrypt as Cipher;
use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use App\Models\Backend\License as model;
use Illuminate\Http\Request;

class LicenseController
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
        'index' => 'backend.license.index',
        'create' => 'backend.license.create',
        'edit' => 'backend.license.edit',
        'show' => 'backend.license.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.serialkeys',
        'create' => 'admin.serialkeys.create',
        'read' => 'admin.serialkeys.view',
        'update' => 'admin.serialkeys.update',
        'deleteX' => 'admin.serialkeys.deactivate',
        'delete' => 'admin.serialkeys.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.license.index',
        'create' => 'admin.license.create',
        'edit' => 'admin.license.edit',
        'show' => 'admin.license.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'License';

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
            json_decode($request->license_data);
            $date = date('Y-m-d H:i:s');
            $crypto = new Cipher();
            $request->request->add(['license_key' => $crypto->encrypt($request->license_data)]);
            $request->request->add(['created_at' => $date, 'updated_at' => $date]);
        } catch (\Exception $e) {
            $this->forbiddenMessage = __($e->getMessage());
            $this->bail();
        }

        return $this->baseStore($request);
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->baseUpdate($request, $id, ['name', 'phone', 'email', 'user_id', 'valid_until', 'license_data']);
    }

    /**
     * Update a given resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return $this->baseEdit($request, $id, ['name', 'phone', 'email', 'user_id', 'valid_until']);
    }
}

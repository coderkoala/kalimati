<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Notices as model;
use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use Illuminate\Http\Request;
use App\Http\Controllers\Classes\KoalaCipherEncrypt as Cipher;

/**
 * Class NoticesController.
 */
class NoticesController
{
    use HttpController {
        store as baseStore;
        update as baseUpdate;
        edit as baseEdit;
        create as baseCreate;
    }

    /**
     * Properties for dep injection.
     */
    private $model;
    private $fieldData;

    // Stored views, so functors can pivot out to the right view.
    private $views = [
        'index' => 'backend.notices.index',
        'create' => 'backend.notices.create',
        'edit' => 'backend.notices.edit',
        'show' => 'backend.notices.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.notices',
        'create' => 'admin.notices.create',
        'read' => 'admin.notices.view',
        'update' => 'admin.notices.update',
        'deleteX' => 'admin.notices.deactivate',
        'delete' => 'admin.notices.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.notices.index',
        'create' => 'admin.notices.create',
        'edit' => 'admin.notices.edit',
        'show' => 'admin.notices.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Notice, Publication and Reports';

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
    public function create(Request $request)
    {
        return $this->baseCreate($request, [
            'title_en',
            'content_en',
            'title_np',
            'content_np',
            'type',
            'published_at',
            'modal_view'
        ]);
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
            $request->request->add([
                'created_by' => \Auth::user()->id,
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
        $request->request->add([
            'created_by' => \Auth::user()->id,
        ]);
        return $this->baseUpdate($request, $id, [
            'title_en',
            'content_en',
            'title_np',
            'content_np',
            'type',
            'published_at',
            'modal_view'
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
            'title_en',
            'content_en',
            'title_np',
            'content_np',
            'type',
            'published_at',
            'modal_view'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Classes\KoalaCipherEncrypt as Cipher;
use App\Http\Controllers\Traits\KoalaHttpController as HttpController;
use App\Models\Backend\Articles as model;
use Illuminate\Http\Request;

/**
 * Class ArticlesController.
 */
class ArticlesController
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
        'index' => 'backend.articles.index',
        'create' => 'backend.articles.create',
        'edit' => 'backend.articles.edit',
        'show' => 'backend.articles.show',
    ];

    // Explicitely define this, so trait functors rely on permission checking.
    private $permissions = [
        'all' => 'admin.articles',
        'create' => 'admin.articles.create',
        'read' => 'admin.articles.view',
        'update' => 'admin.articles.update',
        'deleteX' => 'admin.articles.deactivate',
        'delete' => 'admin.articles.delete',
    ];

    // Necessary. Traits are hollow.
    private $routes = [
        'index' => 'admin.articles.index',
        'create' => 'admin.articles.create',
        'edit' => 'admin.articles.edit',
        'show' => 'admin.articles.show',
    ];

    // This will be injected in all KoalaHttpController functors.
    private $resourceName = 'Article';

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
    public function menu(Request $request)
    {
        return view('backend.articles.menu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function menuR(Request $request)
    {
        try {
            $menu = json_encode($request->data);
            $menu = json_decode($menu, true);
            if ($menu) {
                setting()->set('DATA_MENU', $menu);
                setting()->save();
            } else {
                setting()->forget('DATA_MENU');
                setting()->save();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true], 200);
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
            'title_np',
            'content_en',
            'content_np',
            'comment_status',
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
            $crypto = new Cipher();
            $articleSlug = $crypto->slugify($request->title_en);

            // Check if articleSlug already exists. If it does, append a number to the end and recheck.
            $articleSlugCount = $this->model->where('slug', 'like', "%$articleSlug%")->count();
            if ($articleSlugCount > 0) {
                $articleSlug = $articleSlug.'-'.++$articleSlugCount;
            }

            // Get current userid .
            $user_id = \Auth::user()->id;

            $content_excerpt_en = mb_substr(strip_tags($request->content_np), 0, 157, 'UTF-8').'...';
            $content_excerpt_np = mb_substr(strip_tags($request->content_np), 0, 157, 'UTF-8').'...';

            $request->request->add([
                'slug' => $articleSlug,
                'user_id' => $user_id,
                'content_excerpt_en' => $content_excerpt_en,
                'content_excerpt_np' => $content_excerpt_np,
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
        $user_id = \Auth::user()->id;
        $request->request->add([
            'user_id' => $user_id,
        ]);

        return $this->baseUpdate($request, $id, [
            'article_uuid',
            'slug',
            'article_url',
            'title_en',
            'title_np',
            'content_en',
            'content_excerpt_en',
            'content_np',
            'content_excerpt_np',
            'user_id',
            'status',
            'comment_status',
            'published_at',
            'created_at',
            'modified_at',
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
            'title_np',
            'content_en',
            'content_excerpt_en',
            'content_np',
            'content_excerpt_np',
            'status',
            'comment_status',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\postsHasCategories;
use Intervention\Image\ImageManagerStatic as Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation{ destroy as traitDestroy; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation { bulkDelete as traitBulkDelete; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation { show as traitShow; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('id');

        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();
        CRUD::column('title');
        CRUD::column('body');
        CRUD::addColumn([
            'name'      => 'photos', // The db column name
            'label'     => 'Photos', // Table column heading
            'type'      => 'image',
            'prefix'    => 'storage/'
        ]);

        // CRUD::column('category');
        CRUD::addColumn([
            // any type of relationship
            'name'         => 'categories', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Category', // Table column heading
            // OPTIONAL
            // 'entity'    => 'tags', // the method that defines the relationship in your Model
            // 'attribute' => 'name', // foreign key attribute that is shown to user
            // 'model'     => App\Models\Category::class, // foreign key model
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);

        // CRUD::field('id');
        CRUD::field('title');
        CRUD::field('body');
        // CRUD::addField([
        //     'name'      => 'photos', // The db column name
        //     'label'     => 'Photos', // Table column heading
        //     'type'      => 'base64_image',
        //     'filename'     => "image_filename",
        //     'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
        //     'crop'         => true, // set to true to allow cropping, false to disable
        //     'src'          => NULL, // nul
        // ]);
        CRUD::addField([
            'name'      => 'photos',
            'label'     => 'Photos',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        CRUD::addField([
            'label'     => 'Category',
            'type'      => 'select2_multiple', //https://github.com/Laravel-Backpack/CRUD/issues/502
            'name'      => 'categories',
            'entity'    => 'categories', // the method that defines the relationship in your Model
            'attribute' => 'title',
            'model'     => "App\Models\Category",
            //'group_by_attribute' => 'name', // the attribute on related model, that you want shown
            // 'group_by_relationship_back' => 'category', // relationship from related model back to this model

          ]);
    }
    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

    }
    public function show($id)
    {
        $crud = $this->crud;
        $entry = $this->crud->getEntry($id);
        return view('admin.posts.show', compact('entry', 'crud'));
    }

}

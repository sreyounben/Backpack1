<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
    $this->crud->addFilter([
        'name'  => 'name',
        'type'  => 'select2',
        'label' => 'Name'
      ],
      function () {
        return Product::all()->pluck('name', 'name')->toArray();
      }, function ($value) { // if the filter is active
        $this->crud->addClause('where','name', $value);
      });
        $this->crud->addColumn([
            'name'      => 'row_number',
            'type'      => 'row_number',
            'label'     => '#',
            'orderable' => false,
        ])->makeFirstColumn();

        CRUD::column('code');
        CRUD::column('name');
        CRUD::addColumn([
            'name'      => 'image', // The db column name
            'label'     => 'Image', // Table column heading
            'type'      => 'image',
            'prefix'    => 'storage/'
        ]);
        $this->crud->addColumn([
            'name'     => 'price',
            'label'    => 'price',
            'type'     => 'closure',
            'function' => function($entry) {
                return '$'.number_format($entry->price, 2);
            }
        ]);
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'pice',
            'label' => 'Price'
          ],
          false,
          function($value) { // if the filter is active
             $this->crud->addClause('where', 'price', 'LIKE', "%$value%");
          });
          $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'code',
            'label' => 'Code'
          ],
          false,
          function($value) { // if the filter is active
             $this->crud->addClause('where', 'code', 'LIKE', "%$value%");
          });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);
        $this->crud->addFilter([
            'name'  => 'code',
            'type'  => 'select2_multiple',
            'label' => 'Code'
          ], function() {
              return [
                1 => 'In stock',
                2 => 'In provider stock',
                3 => 'Available upon ordering',
                4 => 'Not available',
              ];
          }, function($values) { // if the filter is active
              // $this->crud->addClause('whereIn', 'status', json_decode($values));
        });

        CRUD::addField([
            'label' => 'Code',
            'name' => 'code',
            'type' => 'number'
         ]);
        CRUD::field('name');
        CRUD::addField([
            'label' => 'Price',
            'name' => 'price',
            'type' => 'number'
        ]);

        // Select 1

        CRUD::addField([
            'name'      => 'image',
            'label'     => 'Image',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        CRUD::addField([

            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id',
            'entity'    => 'category',

            // optional - manually specify the related model and attribute
            'model'     => "App\Models\Category", // related model
            'attribute' => 'title', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                 return $query->orderBy('title', 'ASC')->where('title','<>', 'Note Book')->get();
            }),
        ]);

        // CRUD::addField([
        //   // 1-n relationship
        //     'label'       => "Category", // Table column heading
        //     'type'        => "select2_from_ajax",
        //     'name'        => 'category_id', // the column that contains the ID of that connected entity
        //     'entity'      => 'category', // the method that defines the relationship in your Model
        //     'attribute'   => 'title', // foreign key attribute that is shown to user
        //     'data_source' => url("/api/category"),
        //     'placeholder'             => "Select a category",
        //     'minimum_input_length'    =>  1
        // ]);

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

        return view('admin.products.show', compact('entry', 'crud'));
    }
}

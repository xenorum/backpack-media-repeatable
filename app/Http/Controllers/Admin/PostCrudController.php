<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Post::class);
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
        CRUD::setFromDb(); // set columns from db columns.
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
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
        //CRUD::setFromDb(); // set fields from db columns.

        $this->crud->addFields(
            [
                [
                    'name' => 'title',
                    'label' => 'Post Title',
                    'type' => 'text',
                ],
                [
                    'name' => 'description',
                    'label' => 'Post Description',
                    'type' => 'text',
                ]
            ]
        );

        $this->crud->addFields(
            [
                [
                    'name' => 'subPost',
                    // We use repeatable instead of relationship to have more control over the rows etc
                    'type' => "repeatable",
                    'init_rows' => 1, // By default
                    'min_rows' => 1, // You cannot delete the last one
                    'max_rows' => 1, // You cannot add more rows
                    'label' => 'subPost',
                    'subfields' => [
                        [
                            'name' => 'title',
                            'label' => 'Title'
                        ],
                        [
                            'name' => 'description',
                            'label' => 'Description',
                            'type' => 'text',
                        ],
                        [
                            'name' => 'main_image',
                            'label' => 'Main Image',
                            'type' => 'image',
                            'withMedia' => [

                            ],
                        ],
                    ],
                ]
            ]
        );
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
}

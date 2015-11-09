<?php namespace Blupl\Franchises\Validation;

use Orchestra\Support\Validator;

class Media extends Validator
{
    /**
     * List of rules.
     *
     * @var array
     */
    protected $rules = [
//        'name' => ['required']
//        'phone' => ['required'],
//        'address' => ['required'],
    ];

    /**
     * List of events.
     *
     * @var array
     */
    protected $events = [
        'blupl.franchises.validate: franchises',
    ];

    /**
     * On create validations.
     *
     * @return void
     */
    protected function onCreate()
    {
//        $this->rules['name'][] = 'unique:roles,name';
    }

    /**
     * On update validations.
     *
     * @return void
     */
    protected function onUpdate()
    {
//        $this->rules['name'][] = 'unique:roles,name,{roleID}';
    }
}

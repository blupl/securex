<?php namespace Blupl\Securex\Http\Controllers\Admin;

use Blupl\Securex\Model\Securex;
use Illuminate\Support\Facades\Input;
use Orchestra\Foundation\Http\Controllers\AdminController;

class HomeController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
     * Get landing page.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->processor->index($this);
    }

    public function indexSucceed(array $data)
    {
        set_meta('title', 'blupl/securex::title.securex');

        return view('blupl/securex::index', $data);
    }


    /**
     * Show a role.
     *
     * @param $securex
     * @return mixed
     * @internal param int $roles
     *
     */
    public function show($securex)
    {
        return $this->edit($securex);
    }

    /**
     * Create a new role.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->processor->create($this);
    }

    /**
     * Edit the role.
     *
     * @param $securex
     * @return mixed
     * @internal param int $roles
     *
     */
     public function edit($securex)
     {
        return $this->processor->edit($this, $securex);
     }

    /**
     * Create the role.
     *
     * @return mixed
     */
     public function store()
     {
        return $this->processor->store($this, Input::all());
     }

    /**
     * Update the role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function update($securex)
    {
        return $this->processor->update($this, Input::all(), $securex);
    }

    /**
     * Request to delete a role.
     *
     * @param  int  $roles
     *
     * @return mixed;
     */
    public function delete($securex)
    {
        return $this->destroy($securex);
    }

    /**
     * Request to delete a role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function destroy($securex)
    {
        return $this->processor->destroy($this, $securex);
    }


    /**
     * Response when create role page succeed.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function createSucceed(array $data)
    {
        set_meta('title', trans('blupl/securex::title.securex.create'));

        return view('blupl/securex::edit', $data);
    }

    /**
     * Response when edit role page succeed.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function editSucceed(array $data)
    {
        set_meta('title', trans('blupl/securex::title.securex.update'));

        return view('blupl/securex::edit', $data);
    }

    /**
     * Response when storing role failed on validation.
     *
     * @param  object  $validation
     *
     * @return mixed
     */
     public function storeValidationFailed($validation)
     {
        return $this->redirectWithErrors(handles('orchestra::securex/reporter/create'), $validation);
     }

    /**
     * Response when storing role failed.
     *
     * @param  array  $error
     *
     * @return mixed
     */
     public function storeFailed(array $error)
     {
        $message = trans('orchestra/foundation::response.db-failed', $error);

        return $this->redirectWithMessage(handles('orchestra::securex/reporter'), $message);
     }

    /**
     * Response when storing user succeed.
     *
     * @param  \Orchestra\Model\Role  $role
     *
     * @return mixed
     */
     public function storeSucceed(securex $securex)
     {
        $message = trans('blupl/securex::response.securex.create', [
            'name' => $securex->getAttribute('name')
        ]);

            return $this->redirectWithMessage(handles('orchestra::securex/reporter'), $message);
     }

    /**
     * Response when updating role failed on validation.
     *
     * @param  object  $validation
     * @param  int     $id
     *
     * @return mixed
     */
     public function updateValidationFailed($validation, $id)
     {
        return $this->redirectWithErrors(handles("orchestra::securex/reporter/{$id}/edit"), $validation);
     }

    /**
     * Response when updating role failed.
     *
     * @param  array  $errors
     *
     * @return mixed
     */
     public function updateFailed(array $errors)
     {
        $message = trans('orchestra/foundation::response.db-failed', $errors);

        return $this->redirectWithMessage(handles('orchestra::securex/reporter'), $message);
     }

    /**
     * Response when updating role succeed.
     */
    public function updateSucceed(securex $securex)
    {
        $message = trans('orchestra/control::response.roles.update', [
            'name' => $securex->getAttribute('name')
        ]);

        return $this->redirectWithMessage(handles('orchestra::securex'), $message);
    }

    /**
     * Response when deleting role failed.
     *
     * @param  array  $error
     *
     * @return mixed
     */
    public function destroyFailed(array $error)
    {
        $message = trans('orchestra/foundation::response.db-failed', $error);

        return $this->redirectWithMessage(handles('orchestra::securex'), $message);
    }

    /**
     * Response when updating role succeed.
     *
     * @param  \Orchestra\Model\Role  $role
     *
     * @return mixed
     */
    public function destroySucceed(securex $securex)
    {
        $message = trans('orchestra/control::response.roles.delete', [
            'name' => $securex->getAttribute('name')
        ]);

   ;     return $this->redirectWithMessage(handles('orchestra::securex'), $message);
    }

    /**
     * Response when user verification failed.
     *
     * @return mixed
     */
    public function userVerificationFailed()
    {
        return $this->suspend(500);
    }

}
<?php namespace Blupl\Franchises\Processor;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Blupl\Franchises\Model\Franchises as Eloquent;
use Orchestra\Contracts\Foundation\Foundation;
use Blupl\Franchises\Http\Presenters\FranchisesPresenter as FranchisesPresenter;
//use Blupl\Franchises\Validation\Franchise as FranchisesValidator;

class Franchises extends Processor
{
    /**
     * Setup a new processor instance.
     *
     */
    public function __construct(FranchisesPresenter $presenter,  Foundation $foundation)
    {
        $this->presenter  = $presenter;
//        $this->validator  = $validator;
        $this->foundation = $foundation;
        $this->model = $foundation->make('Blupl\Franchises\Model\Franchises');


    }

    /**
     * View list roles page.
     *
     * @param  object  $listener
     *
     * @return mixed
     */
    public function index($listener)
    {
        $eloquent = $this->model->newQuery();
        $table    = $this->presenter->table($eloquent);

        $this->fireEvent('list', [$eloquent, $table]);

        // Once all event listening to `orchestra.list: role` is executed,
        // we can add we can now add the final column, edit and delete
        // action for roles.
        $this->presenter->actions($table);

        return $listener->indexSucceed(compact('eloquent', 'table'));
    }

    /**
     * View create a role page.
     *
     * @param  object  $listener
     *
     * @return mixed
     */
    public function create($listener)
    {
        $eloquent = $this->model;
        $form     = $this->presenter->form($eloquent);

        $this->fireEvent('form', [$eloquent, $form]);

        return $listener->createSucceed(compact('eloquent', 'form'));
        return $listener->createSucceed();
    }

    /**
     * View edit a role page.
     *
     * @param  object  $listener
     * @param  string|int  $id
     *
     * @return mixed
     */
    public function edit($listener, $id)
    {
        $eloquent = $this->model->findOrFail($id);
        $form     = $this->presenter->form($eloquent);

        $this->fireEvent('form', [$eloquent, $form]);

        return $listener->editSucceed(compact('eloquent', 'form'));
    }

    /**
     * Store a role.
     *
     * @param  object $listener
     * @param $request
     * @return mixed
     * @internal param array $input
     *
     */
    public function store($listener, $request)
    {
        $franchise = $this->model;

        try {

            $this->saving($franchise, $request, 'create');
        } catch (Exception $e) {
            return $listener->storeFailed(['error' => $e->getMessage()]);
        }

        return $listener->storeSucceed('yoo');
    }

    /**
     * Update a role.
     *
     * @param  object  $listener
     * @param  array   $input
     * @param  int     $id
     *
     * @return mixed
     */
    public function update($listener, array $input, $id)
    {
        if ((int) $id !== (int) $input['id']) {
            return $listener->userVerificationFailed();
        }

        $validation = $this->validator->on('update')->bind(['roleID' => $id])->with($input);

        if ($validation->fails()) {
            return $listener->updateValidationFailed($validation, $id);
        }

        $role = $this->model->findOrFail($id);

        try {
            $this->saving($role, $input, 'update');
        } catch (Exception $e) {
            return $listener->updateFailed(['error' => $e->getMessage()]);
        }

        return $listener->updateSucceed($role);
    }

    /**
     * Delete a role.
     *
     * @param  object  $listener
     * @param  string|int  $id
     *
     * @return mixed
     */
    public function destroy($listener, $id)
    {
        $role = $this->model->findOrFail($id);

        try {
            DB::transaction(function () use ($role) {
                $role->delete();
            });
        } catch (Exception $e) {
            return $listener->destroyFailed(['error' => $e->getMessage()]);
        }

        return $listener->destroySucceed($role);
    }

    /**
     * Save the role.
     *
     * @param Eloquent $franchise
     * @param $request
     * @param  string $type
     * @return bool
     * @internal param \Orchestra\Model\Role $role
     * @internal param array $input
     */
    protected function saving(Eloquent $franchise, $request, $type = 'create')
    {
//       dd($request->all());

        $beforeEvent = ($type === 'create' ? 'creating' : 'updating');
        $afterEvent  = ($type === 'create' ? 'created' : 'updated');

        $franchise->setAttributes('accredit_category', $request->accredit_category);
        $franchise->setAttributes('name_franchise', $request->name_franchise);
        $franchise->setAttributes('name_applicant', $request->name_applicant);
        $franchise->setAttributes('nationality', $request->nationality);
        $franchise->setAttributes('passport_nid', $request->passport_nid);
        $franchise->setAttributes('role', $request->role);
        $franchise->setAttributes('date_of_birth', $request->date_of_birth);
        $franchise->setAttributes('country_of_birth', $request->country_of_birth);
        $franchise->setAttributes('phone', $request->phone);
        $franchise->setAttributes('passport_expire_date', $request->passport_expire_date);
        $franchise->setAttributes('noc', $request->accredit_category);
        $franchise->setAttributes('mail', $request->mail);
        $franchise->setAttributes('photo', $request->photo);
        $franchise->setAttributes('attachment', $request->attachment);

        $franchise->save();

//        $franchises->setAttribute('phone', $input['phone']);
//        $franchises->setAttribute('address', $input['address']);
//        dd($franchise);
//        $this->fireEvent($beforeEvent, [$franchise]);
//        $this->fireEvent('saving', [$franchise]);

//        DB::transaction(function () use ($franchise) {
//
//        });
//        $organization = $franchises->create($request->organization);
//        $organization->member()->insert($request->officer);
//        $organization->reporter()->insert($request->reporter);

//        $this->fireEvent($afterEvent, [$franchise]);
//        $this->fireEvent('saved', [$franchise]);
//        dd($franchise);

        return true;
    }

    /**
     * Fire Event related to eloquent process.
     *
     * @param  string  $type
     * @param  array   $parameters
     *
     * @return void
     */
    protected function fireEvent($type, array $parameters = [])
    {
        Event::fire("blupl.franchises.{$type}: franchise", $parameters);
    }
}

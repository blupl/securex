<?php namespace Blupl\Securex\Http\Controllers;

use Blupl\Securex\Http\Requests\SecurexRequest;
use Blupl\Securex\Model\Securex;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;

/**
 * Class SecurexController
 * @package Blupl\Securex\Http\Controllers
 */
class SecurexController extends AdminController {

    public function __construct()
    {
//        $this->middleware('registration');
        $this->middleware('securex');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Securex $securex)
	{
        return view('blupl/securex::securex', compact('securex'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('blupl/securex::edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(SecurexRequest $request )
	{
        try {
            $file = Input::file('file1');
            $filename1 = 'securex_'.uniqid() . '.jpg';
            $destinationPath = 'images/securex';
            $itemImage = Image::make($file)->fit(350, 450);
            $itemImage->save($destinationPath . '/' . $filename1);
            $request['photo'] = $destinationPath.'/'.$filename1;

            $attachFile = Input::file('file2');
            $filename2 = 'securex_attach_'.uniqid() . '.jpg';
            $destinationPathAttach = 'images/securex';
            $itemAttachment = Image::make($attachFile)->fit(450, 350);

            $itemAttachment->save($destinationPathAttach . '/' . $filename2);
            $request['attachment'] = $destinationPathAttach.'/'.$filename2;

            $securex = Securex::create($request->all());

        } catch (Exception $e) {
            Flash::error('Unable to Save');
            return $this->redirect(handles('blupl/securex::securex'));
        }
        Flash::success($securex->name.' Saved Successfully');
        return $this->redirect(handles('blupl/securex::member'));
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

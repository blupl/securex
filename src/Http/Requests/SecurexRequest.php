<?php namespace Blupl\Securex\Http\Requests;

use App\Http\Requests\Request;

/**
 * Class SecurexRequest
 * @package Blupl\Securex\Http\Requests
 */
class SecurexRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'personal_id' => 'required',
            'date_of_birth' => 'required',
            'role' => 'required',
            'workstation' => 'required',
            'present_address1' => 'required',
            'permanent_address1' => 'required',
            'file1' => 'required',
            'file2' => 'required',
		];
	}
}

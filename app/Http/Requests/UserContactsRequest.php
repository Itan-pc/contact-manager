<?php


namespace App\Http\Requests;


class UserContactsRequest extends ApiFormRequest
{
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
		$id = $this->route()->parameter('contact');

		$rules = [
			'first_name'   => 'required|string',
			'email'        => 'required|email|unique:user_contacts',
			'phone_number' => 'required|phone:AUTO,UA'
		];

		if ($id) {
			$rules['email'] = 'required|email|unique:user_contacts,id,' . $id;
		}

        return $rules;
    }
}

<?php


namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\ContactImportRequest;
use App\Http\Requests\UserContactsRequest;
use App\Http\Resources\UserContactsCollection;
use App\Http\Resources\UserContactsResource;
use App\Imports\ContactImport;
use App\Services\KlaviyoApiService;
use App\Services\UserContactService;
use App\Services\ValueObjects\MembersObject;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class UserContactsController extends Controller
{
	/**
	 * @var UserContactService
	 */
	private $userContactService;

	/**
	 * @var KlaviyoApiService
	 */
	private $klaviyoApiService;

	/**
	 * UserContactsController constructor.
	 *
	 * @param UserContactService $userContactService
	 * @param KlaviyoApiService $klaviyoApiService
	 */
	public function __construct(
		UserContactService $userContactService,
		KlaviyoApiService $klaviyoApiService
	)
	{
		$this->userContactService = $userContactService;
		$this->klaviyoApiService = $klaviyoApiService;
	}

	/**
     * Display a listing of the resource.
     *
     * @return UserContactsCollection
     */
    public function index(): UserContactsCollection
    {
    	return new UserContactsCollection($this->userContactService->getContactsByUserId(Auth::user()->id));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param UserContactsRequest $request
	 * @param MembersObject $membersObject
	 * @return UserContactsResource
	 * @throws ValidationException
	 */
    public function store(UserContactsRequest $request, MembersObject $membersObject): UserContactsResource
    {
    	/** @var User $user */
    	$user = Auth::user();
    	$contact = $this->userContactService->create(array_merge($request->validated(), ['user_id' => $user->id]));
    	$list_id = $user->list_id;

    	$member = $this->klaviyoApiService->addMembersToList($list_id, $membersObject->addMember($contact->toMember()));

    	if (!empty($member)) {
			$this->userContactService->update($contact, ['member_id' => $member[0]['id']]);
		}

    	return new UserContactsResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserContactsResource
     */
    public function show($id): UserContactsResource
    {
        $contact = $this->userContactService->getContactById($id);

        return new UserContactsResource($contact);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UserContactsRequest $request
	 * @param MembersObject $membersObject
	 * @param $id
	 * @return UserContactsResource
	 * @throws ValidationException
	 */
    public function update(UserContactsRequest $request, MembersObject $membersObject, $id): UserContactsResource
    {
		$contact = $this->userContactService->update(
			$this->userContactService->getContactById($id),
			$request->validated()
		);

		$list_id = Auth::user()->list_id;

		$this->klaviyoApiService->addMembersToList($list_id, $membersObject->addMember($contact->toMember()));

		return new UserContactsResource($contact);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param $id
	 * @return JsonResponse
	 */
    public function destroy($id): JsonResponse
    {
    	$contact = $this->userContactService->getContactById($id);

    	if ($contact->member_id) {
			$list_id = Auth::user()->list_id;

    		$this->klaviyoApiService->deleteMemberFromListByEmail($list_id, $contact->email);
		}

    	$deleted = $this->userContactService->delete($id);

    	return response()->json(['success' => $deleted]);
    }

	/**
	 * Import contacts
	 *
	 * @param ContactImportRequest $contactImportRequest
	 * @param ContactImport $contactImport
	 * @return JsonResponse
	 */
    public function import(ContactImportRequest $contactImportRequest, ContactImport $contactImport): JsonResponse
	{
		$file = $contactImportRequest->file('file');

		Excel::import($contactImport, $file);

		return response()->json('Success', 200);
	}
}

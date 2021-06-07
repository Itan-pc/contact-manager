<?php


namespace App\Imports;


use App\Services\KlaviyoApiService;
use App\Services\UserContactService;
use App\Services\ValueObjects\MembersObject;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactImport implements ToModel, WithHeadingRow
{
    /**
     * @var KlaviyoApiService
     */
    private $klaviyoApiService;

    /**
     * @var UserContactService
     */
    private $userContactService;

    /**
     * ContactImport constructor.
     *
     * @param KlaviyoApiService $klaviyoApiService
     * @param UserContactService $userContactService
     */
    public function __construct(KlaviyoApiService $klaviyoApiService, UserContactService $userContactService)
    {
        $this->klaviyoApiService = $klaviyoApiService;
        $this->userContactService = $userContactService;
    }

    /**
     * @param array $row
     * @return \App\UserContact|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function model(array $row)
    {
        $row = collect(array_map('strval', $row));
        $user = Auth::user();

        $membersObject = new MembersObject();

        $membersObject->validateMember($row->toArray());
        $row->offsetSet('user_id', $user->id);

        $contact = $this->userContactService->createOrUpdate(['email' => $row->get('email')], $row->toArray());

        $member = $this->klaviyoApiService->addMembersToList(
            $user->list_id,
            $membersObject->addMember($contact->toMember())
        );

        if (!empty($member[0])) {
            $this->userContactService->update($contact, ['member_id' => $member[0]['id']]);
        }

        return $contact;
    }

    /**
     * Heading row
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 1;
    }
}

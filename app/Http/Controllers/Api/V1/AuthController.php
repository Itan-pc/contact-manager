<?php


namespace App\Http\Controllers\Api\V1;


use App\DTO\CreateUserDTO;
use App\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Services\KlaviyoApiService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
	/**
	 * Token name
	 *
	 * @var string
	 */
	protected $tokenName = 'Personal Access Token';

	/**
	 * @var AuthService
	 */
	private $authService;

	/**
	 * @var KlaviyoApiService
	 */
	private $klaviyoApiService;

	/**
	 * @var UserService
	 */
	private $userService;

	/**
	 * AuthController constructor.
	 *
	 * @param AuthService $authService
	 * @param UserService $userService
	 * @param KlaviyoApiService $klaviyoApiService
	 */
	public function __construct(
		AuthService $authService,
		UserService $userService,
		KlaviyoApiService $klaviyoApiService
	)
	{
		$this->authService = $authService;
		$this->userService = $userService;
		$this->klaviyoApiService = $klaviyoApiService;
	}

	/**
	 * Register user
	 *
	 * @param RegisterRequest $request
	 * @return JsonResponse
	 */
	public function register(RegisterRequest $request): JsonResponse
	{
		$createUserDTO = new CreateUserDTO(
			$request->get('name'),
			$request->get('email'),
			$request->get('password')
		);

		$user = $this->authService->register($createUserDTO);
		$accessToken = $user->createToken($this->tokenName)->accessToken;
		$list = $this->klaviyoApiService->createList($user->name . ' - ' . $user->email);

		$this->userService->update(
			$user,
			(new UpdateUserDTO())
				->setListId($list['list_id'])
		);

		return response()->json([
			'user'         => $user,
			'access_token' => $accessToken
		]);
	}

	/**
	 * Login user
	 *
	 * @param LoginRequest $request
	 * @return JsonResponse
	 */
	public function login(LoginRequest $request): JsonResponse
	{
		$user = $this->authService->login($request->validated());

		if (!$user) {
			return response()->json(['message' => 'Invalid Credentials'], 422);
		}

		$accessToken = $user->createToken($this->tokenName)->accessToken;

		return response()->json([
			'user'         => $user,
			'access_token' => $accessToken
		]);
	}

	/**
	 * Logout user
	 *
	 * @return JsonResponse
	 */
	public function logout(): JsonResponse
	{
		$logout = $this->authService->logout();

		if ($logout) {
			return response()->json(['message' =>'Logout success'],200);
		}

		return response()->json(['error' =>'Logout can not be resolved'],500);
	}
}

<?php

namespace App\Http\Controllers;

use App\Model\Authenticator;
use Illuminate\Http\JsonResponse as Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
 * TODO
 * 작성일 : 2020-08-08
 * 작성자 : 정재순
 * 내용 : Laravel Passport Multi-Auth 적용
 * 세부내용
 *   - login_validator()
 *   - login_authenticator()
 *   - adminLogin()
 *      - Request : account, password, provider
 *      - Response : message, admin 정보(이름), bearer token
 *   - foreignerLogin()
 *      - Request : std_for_id, password, provider
 *      - Response : message, foreigner 정보(학번, 이름, 숫자, 언어, 국가, 즐겨찾기), bearer token
 *   - logout()
 *      - Request : Authorization - Bearer token
 *      - Response : message
 *   - adminRequest()
 *     - Request : Authorization - Bearer token
 *     - Response : admin 정보(이름)
 *   - foreignerRequest()
 *     - Request : Authorization - Bearer token
 *     - Response : foreigner 정보(학번, 이름, 숫자, 언어, 국가, 즐겨찾기)
 */

class LoginController extends Controller
{
    private const LOGIN_ERROR = '아이디 또는 비밀번호를 다시 확인하세요.';
    private const LOGIN_SUCCESS = ' 님 로그인 되습니다. 어서오세요';
    private const LOGOUT_SUCCESS = '로그아웃되었습니다.';

    /**
     * @var Authenticator
     */
    private $authenticator;
    private $validator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * 로그인 시, 유효성 검사 실시
     *
     * @param Request $request
     * @param array $rules
     * @return bool
     */
    private function login_validator(
        Request $request,
        array $rules
    ): bool
    {
        $this->validator = Validator::make($request->all(), [
            $rules['key'] => 'required|string',
            'password' => 'required|string|min:8',
            'provider' => 'required|string|in:' . $rules['prov'],
        ]);

        if ($this->validator->fails()) {
            return false;
        }

        return true;
    }

    /**
     * 로그인 시, 사용자 정보 인증
     * @param Request $request
     * @param string $key
     * @return array|null
     */
    private function login_authenticator(
        Request $request,
        string $key
    ): ?array
    {
        $credentials = array_values($request->only($key, 'password', 'provider'));
        $credentials[] = $key;

        if (!$user = $this->authenticator->attempt(...$credentials)) {
            return null;
        }

        $token = $user->createToken(ucfirst($credentials[2]) . ' Token')->accessToken;
        return [
            'result' => $user,
            'token' => $token
        ];
    }

    /**
     * 관리자 로그인
     *
     * @param Request $request
     * @return Json
     */
    public function adminLogin(Request $request): Json
    {
        $rules = [
            'key' => 'account',
            'prov' => 'admins'
        ];

        if (!$this->login_validator($request, $rules)) {
            return response()->json([
                'message' => $this->validator->errors(),
            ], 422);
        }

        if (empty($admin = $this->login_authenticator($request, $rules['key']))) {
            return response()->json([
                'message' => self::LOGIN_ERROR
            ], 401);
        }

        return response()->json([
            'message' => $admin['result']['name'] . self::LOGIN_SUCCESS,
            'name' => $admin['result']['name'],
            'access_token' => $admin['token']
        ], 200);
    }

    /**
     * 외국인 유학생 로그인
     *
     * @param Request $request
     * @return Json
     */
    public function foreignerLogin(Request $request): Json
    {
        $rules = [
            'key' => 'std_for_id',
            'prov' => 'foreigners'
        ];

        if (!$this->login_validator($request, $rules)) {
            return response()->json([
                'message' => $this->validator->errors(),
            ], 422);
        }

        if (empty($foreigner = $this->login_authenticator($request, $rules['key']))) {
            return response()->json([
                'message' => self::LOGIN_ERROR
            ], 401);
        }

        return response()->json([
            'message' => $foreigner['result']['std_for_name'] . self::LOGIN_SUCCESS,
            'id' => $foreigner['result']['std_for_id'],
            'name' => $foreigner['result']['std_for_name'],
            'lang' => $foreigner['result']['std_for_lang'],
            'country' => $foreigner['result']['std_for_country'],
            'favorite' => $foreigner['result']['std_for_state_of_favorite'],
            'access_token' => $foreigner['token']
        ], 200);
    }

    /**
     * 관리자, 유학생 로그아웃
     *
     * @param Request $request
     * @return Json
     */
    public function logout(Request $request): Json
    {
        $request->user($request['guard'])->token()->revoke();

        return response()->json([
            'message' => self::LOGOUT_SUCCESS
        ], 200);
    }

    public function adminRequest(Request $request)
    {
        $admin = $request->user($request['guard']);

        return response()->json([
            'name' => $admin['name']
        ], 200);
    }

    public function foreignerRequest(Request $request)
    {
        $foreigner = $request->user($request['guard']);

        return response()->json([
            'id' => $foreigner['std_for_id'],
            'name' => $foreigner['std_for_name'],
            'lang' => $foreigner['std_for_lang'],
            'country' => $foreigner['std_for_country'],
            'favorite' => $foreigner['std_for_state_of_favorite'],
        ], 200);
    }
}

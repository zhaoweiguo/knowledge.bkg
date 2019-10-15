<?php

class Mod2 extends Controller
{

    /**
     * @api {post} /mod2  模块2
     * @apiName mod2
     * @apiGroup mod
     *
     * @apiDescription 模块2
     *
     * @apiParam {String}  username2 金额（元）
     * @apiParam {String}  password2
     *
     * @apiVersion 1.0.0
     * @apiSuccessExample Success-Response:
     * {
     * access_token' : $token2,   token
     * 'token_type' : 'Bearer2',  前缀
     * 'expires_in': Auth::guard('api')->factory()->getTTL() * 60  有效时间
     * }
     */
    public function mod1(AuthorizationRequest $request)
    {
        $rsaPassword = $this->RSA_Decode($request->get('password'));

        $username = $request['username'];

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['mobile'] = $username;

        $credentials['password'] = $rsaPassword;

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return $this->response->errorUnauthorized('用户名或密码错误');
        }

        return $this->respondWithToken($token)->setStatusCode(201);
    }

}

<?php

class Mod1 extends Controller
{

    /**
     * @api {post} /mod1  模块1
     * @apiName mod1
     * @apiGroup mod
     *
     * @apiDescription 模块1
     *
     * @apiParam {String}  username 金额（元）
     * @apiParam {String}  password
     *
     * @apiVersion 1.0.0
     * @apiSuccessExample Success-Response:
     * {
     * access_token' : $token,   token
     * 'token_type' : 'Bearer',  前缀
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

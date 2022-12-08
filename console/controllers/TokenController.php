<?php

namespace console\controllers;

use yii\console\Controller;
use console\models\account;
use console\models\tokens;

class TokenController extends Controller
{

    public function actionCreate($login, $password)
    {
        $password = md5($password);
        $account = account::find()->where(['login' => $login, 'password' => $password])->one();
        if (empty($account)) echo "There is no such user!\n"; else echo $this->generateToken($login)."\n";;
    }

    public function actionCreateUser($login, $password)
    {
        $account = new account;
        $account->login = $login;
        $account->password = md5($password);
        $account->save();
        echo "successfully!\n";
    }

    public function generateToken($login): string
    {
        $token = md5(time().md5($login).date("Y-m-d H:i:s"));
        $this->insertToken($token, $login);
        return $token;
    }

    public function insertToken($token, $login)
    {
        $time = $this->getTime();
        $token_class = new tokens;
        $token_class->token = $token;
        $token_class->user = $login;
        $token_class->start = $time['now'];
        $token_class->stop = $time['later'];
        $token_class->save();
    }

    public function getTime(): array
    {
        $now = date("Y-m-d H:i:s");
        $later = strtotime($now);
        $later = $later+(60*5);
        $later = date("Y-m-d H:i:s", $later);
        return array('now' => $now, 'later'=>$later);
    }
}
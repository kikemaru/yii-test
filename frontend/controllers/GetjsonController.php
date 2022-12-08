<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use frontend\models\requestdata;
use console\models\tokens;


class GetjsonController extends Controller
{


    public function actionIndex($data = null)
    {
        $headers = ['token_access' => '7792027245b7ff1db87d85f247216434'];
        if ($this->checkTokenInHeader($headers)) {
            if ($this->checkUserToken($headers['token_access'])) {
                if ($this->checkEmptyData($data)) {
                    $this->insertData($headers['token_access'], $data);
                    return $this->render('getjson', ['code' => 200, 'header' => 'success', 'description' => 'the data has been uploaded successfully']);
                } else {
                    return $this->render('getjson', ['code' => 404, 'header' => 'empty', 'description' => 'empty input data']);
                }
            } else {
                return $this->render('getjson', ['code' => 403, 'header' => 'access denied', 'description' => 'you have specified a non-existent token']);
            }
            } else {
            return $this->render('getjson', ['code' => 403, 'header' => 'access denied', 'description' => 'there is no access key!']);
            }
    }

    public function checkEmptyData($data): bool
    {
        if (empty($data)){ return false;} else{ return true;}
    }

    public function checkTokenInHeader(array $header): bool
    {
        if (empty($header['token_access'])){return false;}else{return true;}
    }

    public function insertData($token, $data)
    {
        $login = $this->getLogin($token);
        $data_request = new requestdata;
        $data_request->user = $login;
        $data_request->data = $data;
        $data_request->save();
    }

    public function checkUserToken($token): bool
    {
        $token = tokens::find()->where(['token' => $token])->one();
        if (empty($token)){return false;}else{
            if (date("Y-m-d H:i:s") >= $token['stop'])
            {
                return false;
            } else {
                return true;
            }
        }
    }

    public function getLogin($token): string
    {
        $token = tokens::find()->where(['token' => $token])->one();
        if (empty($token)){
            return 'error';
        } else {
            return $token['user'];
        }
    }

}
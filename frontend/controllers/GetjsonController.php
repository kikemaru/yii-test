<?php

namespace frontend\controllers;


use Yii;
use yii\web\Controller;
use frontend\models\requestdata;
use console\models\tokens;


class GetjsonController extends Controller
{


    public function actionIndex()
    {
        $request = Yii::$app->request;
        $data = "";
        if ($request->isPost){ $data = $request->post('data');}
        elseif ($request->isGet){ $data = $request->get('data');} else { $data = NULL;}

        $headers = Yii::$app->request->headers;
        $headers = $headers->get('token_access');
        if (empty($data)) {
            return $this->render('getjson', ['code' => 400, 'header' => 'bad request', 'description' => 'you didnt send the data parameter']);
        } else {
            if ($this->checkTokenInHeader($headers)) {
                if ($this->checkUserToken($headers)) {
                    if ($this->checkEmptyData($data)) {
                        $this->insertData($headers, $data);
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
    }

    public function checkEmptyData($data): bool
    {
        if (empty($data)){ return false;} else{ return true;}
    }

    public function checkTokenInHeader(string $header): bool
    {
        if (empty($header)){return false;}else{return true;}
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
<?php
Yii::$app->request->csrfParam;
Yii::$app->response->statusCode = $code;
echo $result = json_encode(array('code' => $code, 'header' => $header, 'description' => $description));
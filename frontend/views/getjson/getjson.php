<?php
Yii::$app->response->statusCode = $code;
Yii::$app->response->headers->add('access_token', '853d115288d7403b30c6eab91762e45b');
echo $result = json_encode(array('code' => $code, 'header' => $header, 'description' => $description));
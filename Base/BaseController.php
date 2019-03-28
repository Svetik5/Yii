<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 23.03.2019
 * Time: 20:57
 */

namespace app\assets\Base;


use yii\web\Controller;

class BaseController extends Controller
{
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        $url = \Yii::$app->request->url;
        \Yii::$app->session->set('last_page_url', $url);
        //\Yii::$app->session->setFlash('success', $url);
        return $result;
    }

}
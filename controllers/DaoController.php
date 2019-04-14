<?php


namespace app\controllers;




use app\components\DaoComponent;
use yii\filters\PageCache;
use yii\web\Controller;

class DaoController extends Controller
{
    public function behaviors()
    {
        return [
            ['class' => PageCache::class,'only' => ['index'],'duration' => 6]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(){

       // \Yii::$app->cache->set('key1','value1');
        $val=\Yii::$app->get('key1');
        $val=\Yii::$app->cache->getOrSet('key2',function (){
  //          return 'val2';
        });
        \Yii::$app->cache->flush();

        echo $val;

        exit;


        /** @var DaoComponent $copm */
        $copm=\Yii::createObject(['class'=>DaoComponent::class]);


        $copm->insertsAndUpdates();

        $users=$copm->getAllUsers();
        $activityUser=$copm->getActivityUsers(\Yii::$app->request->get('user',1));
        $user=$copm->getUser(\Yii::$app->request->get('user',1));
        $cnt=$copm->getCountActivity();
        $reader=$copm->getReaderActivity();
        return $this->render('index',['users'=>$users,
            'acitvityUser'=>$activityUser,'user'=>$user,
            'cnt'=>$cnt,'reader'=>$reader]);
    }
}
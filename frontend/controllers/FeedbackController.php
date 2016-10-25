<?php

namespace frontend\controllers;

use Yii;
use common\models\Feedback;
use yii\web\HttpException;
use yii\web\UploadedFile;

class FeedbackController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->uploadedFile = UploadedFile::getInstance($model, 'file');
            $model->file = $model->uploadedFile->baseName.'.'.$model->uploadedFile->extension;
            if($model->save()){
                $model->fileUpload();
                $session = Yii::$app->session;
                $session['feedback_id'] = $model->id;
                return $this->redirect('/feedback/result');
            }
        }
        else {
            return $this->render('index',[
                'model' => $model,
            ]);
        }
    }

    public function actionResult(){
        $session = Yii::$app->session;
        $model = new Feedback();
        $feed = $model->getFeed($session['feedback_id']);


        if(!$feed){
            throw new HttpException(404, 'Страница не найдена');
        }
        else{
            return $this->render('result',[
                'feed' => $feed,
            ]);
        }
    }

}

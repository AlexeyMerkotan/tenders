<?php


namespace frontend\controllers;

use common\models\TenderSearch;
use yii\web\Controller;


class TenderController extends Controller
{
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            $searchModel = new TenderSearch();
            $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->redirect('/');
    }
}
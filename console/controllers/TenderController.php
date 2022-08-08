<?php

namespace console\controllers;

use Yii;
use common\components\Tender;
use yii\console\Controller;
use yii\helpers\Console;

class TenderController extends Controller
{
    public function actionIndex()
    {
        $tender = new Tender();
        try {
            $tender->getTender();
            $this->stdout("Success get tender\n", Console::FG_GREEN);
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
            $this->stdout("Error get tender\n", Console::BG_RED);
            $this->stdout($e->getMessage(), Console::BG_RED);
        }
    }
}
<?php

namespace frontend\controllers;

use frontend\models\finance\Details;
use Yii;

class FinanceController extends AccessLoginOnly
{
    public function actionShow()
    {
        $finance = Yii::$app->request->post('Finance');
        if ($finance) {
            $models = Details::createDuplicateForDate($finance['date']);

            return $this->render('details/show', ['models' => $models]);
        }

        return $this->render('show');
    }
}

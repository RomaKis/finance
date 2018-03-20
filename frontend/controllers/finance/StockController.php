<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Stock;
use Yii;

class StockController extends AccessLoginOnly
{
    public function actionAdd()
    {
        $model = new Stock();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model = new Stock();
        }

        return $this->render('add', ['model' => $model]);
    }
}

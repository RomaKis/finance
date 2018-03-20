<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Rate;
use Yii;

class RateController extends AccessLoginOnly
{
    public function actionAdd()
    {
        $model = new Rate();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model = new Rate();
        }

        return $this->render('add', ['model' => $model]);
    }
}

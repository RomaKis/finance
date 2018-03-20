<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Details;
use Yii;

class DetailsController extends AccessLoginOnly
{
    public function actionAdd()
    {
        $model = new Details();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model = new Details();
        }
        $model->isActive = true;

        return $this->render('add', ['model' => $model]);
    }

    public function actionShow()
    {
        return $this->render('show');

    }
}

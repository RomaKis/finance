<?php

namespace frontend\controllers;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Details;
use Yii;

class FinanceController extends AccessLoginOnly
{
    public function actionShow()
    {
        return $this->render('show');
    }
}

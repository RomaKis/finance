<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;

class MainController extends AccessLoginOnly
{
    public function actionAdd()
    {
        return $this->render('add');
    }
}

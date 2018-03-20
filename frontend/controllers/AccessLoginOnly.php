<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Add check if user is login and if not -> redirect to home page.
 */
class AccessLoginOnly extends Controller
{
    public function beforeAction($action)
    {
        if (!$this->isLogin()) {
            $this->goHome();
        }

        return parent::beforeAction($action);
    }

    private function isLogin()
    {
        $isLogin = false;
        if (!Yii::$app->user->getIsGuest()) {
            $isLogin = true;
        }

        return $isLogin;
    }
}

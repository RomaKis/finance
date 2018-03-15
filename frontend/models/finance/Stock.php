<?php

namespace frontend\models\finance;

use Yii;
use yii\base\Model;

class Stock extends Model
{
    public $name;

    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
        ];
    }

    public function save()
    {
        $stock = new \frontend\models\resource\finance\Stock();
        $stock->user_id = Yii::$app->getUser()->getId();
        $stock->name = $this->name;
        $stock->save();
    }

}

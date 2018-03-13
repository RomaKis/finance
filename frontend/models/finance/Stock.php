<?php

namespace frontend\models\finance;

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
        $stock->name = $this->name;
        $stock->save();
    }

}

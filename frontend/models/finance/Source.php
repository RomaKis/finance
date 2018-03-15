<?php

namespace frontend\models\finance;

use Yii;
use yii\base\Model;

class Source extends Model
{
    public $stockId;
    public $name;

    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['stockId', 'required'],
        ];
    }

    public function save()
    {
        $source = new \frontend\models\resource\finance\Source();
        $source->user_id = Yii::$app->getUser()->getId();
        $source->stock_id = $this->stockId;
        $source->name = $this->name;
        $source->save();
    }
}

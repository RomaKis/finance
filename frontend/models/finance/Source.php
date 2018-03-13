<?php

namespace frontend\models\finance;

use frontend\models\resource\finance\Stock;
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
        $source->stock_id = $this->stockId;
        $source->name = $this->name;
        $source->save();
    }

    public function getStockNameById($id)
    {
        $stock = new Stock();
        $stock = $stock->findIdentity(['id' => $id]);

        return $stock->name;
    }
}

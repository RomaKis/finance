<?php

namespace frontend\models\finance;

use yii\base\Model;

class Details extends Model
{
    public function rules()
    {
        return [
            ['currency', 'required'],
            ['coefficient', 'required'],
        ];
    }

    public function save()
    {
        $rate = new \frontend\models\resource\finance\Rate();
        $rate->currency = $this->currency;
        $rate->coefficient = $this->coefficient;
        $rate->save();
    }
}

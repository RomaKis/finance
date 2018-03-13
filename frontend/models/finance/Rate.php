<?php

namespace frontend\models\finance;

use frontend\models\resource\finance\Rate as ResourceRate;
use yii\base\Model;

class Rate extends Model
{
    public $currency;
    public $coefficient;

    public function rules()
    {
        return [
            ['currency', 'required'],
            ['coefficient', 'required'],
        ];
    }

    public function save()
    {
        $rate = ResourceRate::findIdentityByCurrency($this->currency);

        if (null === $rate)
        {
            $rate = new ResourceRate();

        }
        $rate->currency = $this->currency;
        $rate->coefficient = $this->coefficient;
        $rate->save();
    }
}

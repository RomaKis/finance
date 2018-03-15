<?php

namespace frontend\models\finance;

use frontend\models\resource\finance\Rate as ResourceRate;
use Yii;
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
            $rate->user_id = Yii::$app->getUser()->getId();
        }

        $rate->currency = $this->currency;
        $rate->coefficient = $this->coefficient;
        $rate->save();
    }

    public static function getSumUah($tempSum, $currency)
    {
        if ($currency === ResourceRate::UAH) {
            $sum = $tempSum;
        } else {
            $rate = ResourceRate::findIdentityByCurrency($currency);
            $sum = $tempSum * $rate->getAttribute('coefficient');
        }

        return $sum;
    }

    public static function getSumUsd($tempSum, $currency)
    {
        if ($currency === ResourceRate::USD) {
            $sum = $tempSum;
        } else {
            $rate = ResourceRate::findIdentityByCurrency($currency);
            $sum = $tempSum * $rate->getAttribute('coefficient');
            $rateUSD = ResourceRate::findIdentityByCurrency(ResourceRate::USD);
            $sum = $sum / $rateUSD->getAttribute('coefficient');
        }

        return $sum;
    }
}

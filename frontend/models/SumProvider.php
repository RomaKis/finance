<?php

namespace frontend\models;

use frontend\models\finance\Rate;
use frontend\models\resource\finance\Details;
use frontend\models\resource\finance\Rate as ResourceRate;
use yii\base\Model;

class SumProvider extends Model
{
    public static function getSumUahByDate($date)
    {
        $sum = 0;
        $details = Details::findIdentitiesByDate($date);
        /** @var Details $detail */
        foreach ($details as $detail) {
            $currency = $detail->getAttribute('currency');
            if ($currency === ResourceRate::UAH) {
                $sum += $detail->sum;
            } else {
                $sum += Rate::getSumUah($detail->sum, $currency);
            }
        }

        return $sum;
    }

    public static function getActiveSumUahByDate($date)
    {
        $sum = 0;
        $details = Details::findIdentitiesByDate($date);
        /** @var Details $detail */
        foreach ($details as $detail) {
            if ($detail->getAttribute('is_active')) {
                $currency = $detail->getAttribute('currency');
                if ($currency === ResourceRate::UAH) {
                    $sum += $detail->sum;
                } else {
                    $sum += Rate::getSumUah($detail->sum, $currency);
                }
            }
        }

        return $sum;
    }
}

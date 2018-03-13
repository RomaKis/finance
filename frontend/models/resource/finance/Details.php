<?php

namespace frontend\models\resource\finance;

use frontend\models\Finance;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $stock_id
 * @property integer $source_id
 * @property integer $sum
 * @property integer $currency
 * @property integer $is_active
 * @property integer $date
 */
class Details extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%finance_details}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @return array
     */
    public static function findGroupedByDate()
    {
        $data = static::find()->all();
        $finances = [];
        foreach ($data as $datum) {
            $finance = new Finance();

            $finance->date = $datum->getAttribute('date');
            $finance->sumUah += self::getSumUah(
                $datum->getAttribute('sum'),
                $datum->getAttribute('currency')
            );
            $finance->sumUsd += self::getSumUsd(
                $datum->getAttribute('sum'),
                $datum->getAttribute('currency')
            );
            $finances[] = $finance;
        }

        return $finances;
    }

    private static function getSumUah($tempSum, $currency)
    {
        if ($currency === Rate::UAH) {
            $sum = $tempSum;
        } else {
            $rate = Rate::findIdentityByCurrency($currency);
            $sum = $tempSum * $rate->getAttribute('coefficient');
        }

        return $sum;
    }

    private static function getSumUsd($tempSum, $currency)
    {
        if ($currency === Rate::USD) {
            $sum = $tempSum;
        } else {
            $rate = Rate::findIdentityByCurrency($currency);
            $sum = $tempSum * $rate->getAttribute('coefficient');
            $rateUSD = Rate::findIdentityByCurrency(Rate::USD);
            $sum = $sum / $rateUSD->getAttribute('coefficient');
        }

        return $sum;
    }
}

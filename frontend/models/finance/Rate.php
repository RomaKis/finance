<?php

namespace frontend\models\finance;

use yii\db\ActiveRecord;

class Rate extends ActiveRecord
{
    const UAH = 'UAH';
    const EUR = 'EUR';
    const USD = 'USD';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rate}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentitiesByCurrency($currency = self::UAH)
    {
        return static::findOne(['currency' => $currency]);
    }
}

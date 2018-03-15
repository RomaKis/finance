<?php

namespace frontend\models\resource\finance;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $currency
 * @property float $coefficient
 */
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

    public static function findIdentityByCurrency($currency = self::UAH)
    {
        return static::findOne(['currency' => $currency]);
    }

    public static function find()
    {
        $object = parent::find();
        $object->where(['user_id' => Yii::$app->getUser()->getId()]);

        return $object;
    }
}

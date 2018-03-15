<?php

namespace frontend\models\resource\finance;

use Yii;
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
        return static::findOne(['id' => $id, 'user_id' => Yii::$app->getUser()->getId()]);
    }

    public static function findIdentitiesByDate($date)
    {
        return static::findAll(['date' => $date, 'user_id' => Yii::$app->getUser()->getId()]);
    }

    public static function find()
    {
        $object = parent::find();
        $object->where(['user_id' => Yii::$app->getUser()->getId()]);

        return $object;
    }
}

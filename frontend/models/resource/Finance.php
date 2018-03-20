<?php

namespace frontend\models\resource;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $date
 * @property integer $sum_uah
 */
class Finance extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%finance}}';
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

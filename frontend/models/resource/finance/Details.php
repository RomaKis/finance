<?php

namespace frontend\models\finance;

use yii\base\Model;

class Details extends Model
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

    public static function findIdentitiesByUserId($userId)
    {
        return static::findAll(['user_id' => $userId]);
    }

    public function save()
    {
        $rate = new \frontend\models\resource\finance\Rate();
        $rate->currency = $this->currency;
        $rate->coefficient = $this->coefficient;
        $rate->save();
    }
}

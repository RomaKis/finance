<?php

namespace frontend\models\finance;

use yii\db\ActiveRecord;

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

    public static function findIdentitiesByUserId($userId)
    {
        return static::findAll(['user_id' => $userId]);
    }

    public static function findIdentitiesByFinanceId($userId)
    {
        return static::findAll(['finance_id' => $userId]);
    }
}

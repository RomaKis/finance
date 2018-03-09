<?php

namespace frontend\models;

use yii\db\ActiveRecord;

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
        return static::findOne(['id' => $id]);
    }
}

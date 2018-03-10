<?php

namespace frontend\models\resource\finance;

use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $stock
 */
class Stock extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['stock', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stock}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
}

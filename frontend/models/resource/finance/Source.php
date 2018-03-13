<?php

namespace frontend\models\resource\finance;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $stock_id
 * @property string $name
 */
class Source extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['stock_id', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%source}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
}

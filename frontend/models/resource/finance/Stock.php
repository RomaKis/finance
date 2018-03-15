<?php

namespace frontend\models\resource\finance;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 */
class Stock extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
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

    public static function find()
    {
        $object = parent::find();
        $object->where(['user_id' => Yii::$app->getUser()->getId()]);

        return $object;
    }
}

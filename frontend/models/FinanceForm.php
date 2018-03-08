<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class FinanceForm extends ActiveRecord
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

    public static function findIdentitiesByUserId($userId)
    {
        return static::findAll(['user_id' => $userId]);
    }

    public function load($data, $formName = null)
    {
        $userId = 1;//Yii::$app->user->getId();
        $data['user_id'] = $userId;
        return parent::load($data, $formName);
    }
}

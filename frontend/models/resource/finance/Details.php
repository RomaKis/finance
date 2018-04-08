<?php

namespace frontend\models\resource\finance;

use frontend\models\resource\Finance as ResourceFinance;
use frontend\models\SumProvider;
use Yii;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $stock_id
 * @property integer $source_id
 * @property integer $sum
 * @property string $currency
 * @property boolean $is_active
 * @property string $date
 */
class Details extends ActiveRecord
{
    public function rules()
    {
        return [
            [['user_id', 'stock_id', 'source_id', 'sum', 'currency', 'is_active', 'date'], 'safe'],
        ];
    }

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

    public function setAttributes($values, $safeOnly = true)
    {
        if (isset($values['isActive'])) {
            $this->is_active = $values['isActive'];
        } else {
            parent::setAttributes($values, $safeOnly);
        }
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $toReturn = parent::save($runValidation, $attributeNames);

        $date = $this->getAttribute('date');
        $finance = ResourceFinance::findIdentityByDate($date);
        if (!$finance) {
            $finance = new ResourceFinance();
            $finance->setAttribute('date', $date);
            $finance->setAttribute('user_id', Yii::$app->getUser()->getId());
        }
        $finance->setAttribute('sum_uah', SumProvider::getSumUahByDate($date));
        $finance->setAttribute('sum_uah_active', SumProvider::getActiveSumUahByDate($date));
        $finance->save();

        return $toReturn;
    }

    public function delete()
    {
        $toReturn = parent::delete();

        $date = $this->getAttribute('date');
        $finance = ResourceFinance::findIdentityByDate($date);
        $finance->setAttribute('sum_uah', SumProvider::getSumUahByDate($date));
        $finance->setAttribute('sum_uah_active', SumProvider::getActiveSumUahByDate($date));

        if ($finance->sum_uah == 0) {
            $finance->delete();
        } else {
            $finance->save();
        }

        return $toReturn;
    }
}

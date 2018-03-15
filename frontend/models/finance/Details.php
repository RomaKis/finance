<?php

namespace frontend\models\finance;

use frontend\models\SumProvider;
use frontend\models\resource\finance\Details as ResourceDetails;
use yii\base\Model;
use Yii;

class Details extends Model
{
    public $userId;
    public $stockId;
    public $sourceId;
    public $sum;
    public $currency;
    public $isActive;
    public $date;

    public function rules()
    {
        return [
            ['userId', 'required'],
            ['stockId', 'required'],
            ['sourceId', 'required'],
            ['sum', 'required'],
            ['currency', 'required'],
            ['isActive', 'required'],
            ['date', 'required'],
        ];
    }

    public function save()
    {
        $details = new ResourceDetails();
        $details->user_id = Yii::$app->getUser()->getId();
        $details->stock_id = $this->stockId;
        $details->source_id = $this->sourceId;
        $details->sum = $this->sum;
        $details->currency = $this->currency;
        $details->is_active = $this->isActive;
        $details->date = date('Y-m-d', strtotime($this->date));

        $details->save();
    }

    public static function getGroupedByDate()
    {
        $financeDetails = ResourceDetails::find()->all();
        $sumProvider = new SumProvider();

        foreach ($financeDetails as $financeDetail) {
            $sumUah = Rate::getSumUah(
                $financeDetail->getAttribute('sum'),
                $financeDetail->getAttribute('currency')
            );

            $sumProvider->addSumForDate($financeDetail->getAttribute('date'), $sumUah);
        }

        return $sumProvider;
    }

    public static function getActiveGroupedByDate()
    {
        $financeDetails = ResourceDetails::find()->where(['is_active' => 1])->all();
        $sumProvider = new SumProvider();

        foreach ($financeDetails as $financeDetail) {
            $sumUah = Rate::getSumUah(
                $financeDetail->getAttribute('sum'),
                $financeDetail->getAttribute('currency')
            );

            $sumProvider->addSumForDate($financeDetail->getAttribute('date'), $sumUah);
        }

        return $sumProvider;
    }
}

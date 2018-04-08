<?php

namespace frontend\models\finance;

use frontend\models\resource\finance\Details as ResourceDetails;
use yii\base\Model;
use Yii;

class Details extends Model
{
    public $id;
    public $userId;
    public $stockId;
    public $stockName;
    public $sourceId;
    public $sourceName;
    public $sum;
    public $currency;
    public $isActive;
    public $date;

    public function rules()
    {
        return [
            [['stockName', 'sourceName', 'stockId', 'sourceId', 'id'], 'safe'],
            [['userId', 'sum', 'currency', 'isActive', 'date'], 'required'],
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

    public static function findIdentitiesByDate($date)
    {
        $resourceDetails = ResourceDetails::findIdentitiesByDate($date);
        $details = [];
        /** @var ResourceDetails $resourceDetail */
        foreach ($resourceDetails as $resourceDetail) {
            $detail = new Details();
            $detail->id = $resourceDetail->getAttribute('id');
            $detail->userId = $resourceDetail->getAttribute('user_id');
            $detail->sum = $resourceDetail->getAttribute('sum');
            $detail->currency = $resourceDetail->getAttribute('currency');
            $detail->isActive = $resourceDetail->getAttribute('is_active');
            $detail->date = $resourceDetail->getAttribute('date');
            $detail->stockId = $resourceDetail->getAttribute('stock_id');
            $detail->sourceId = $resourceDetail->getAttribute('source_id');
            $detail->stockName = NameByIdProvider::getStockNameById($resourceDetail->getAttribute('stock_id'));
            $detail->sourceName = NameByIdProvider::getSourceNameById($resourceDetail->getAttribute('source_id'));

            $details[] = $detail;
        }

        return $details;
    }

    public static function createDuplicateForDate($date)
    {
        $date = date('Y-m-d', strtotime($date));
        $query = ResourceDetails::find();
        $maxDate = $query->max('date');
        $details = ResourceDetails::findIdentitiesByDate($maxDate);
        foreach ($details as $detail) {
            $newDetail = new \frontend\models\resource\finance\Details();
            $newDetail->setAttributes($detail->getAttributes());
            $newDetail->id = null;
            $newDetail->date = $date;
            $newDetail->save();
        }

        return self::findIdentitiesByDate($date);
    }
}

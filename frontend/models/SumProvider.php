<?php

namespace frontend\models;

use frontend\models\finance\Rate;
use frontend\models\resource\finance\Rate as ResourceRate;
use yii\base\Model;

class SumProvider extends Model
{
    private $sumByDate = [];

    public function addSumForDate($date, $sum)
    {
        if (!isset($this->sumByDate[$date])) {
            $this->sumByDate[$date] = 0;
        }

        $this->sumByDate[$date] += $sum;
    }

    public function getSumByDate($date = null)
    {
        $finances = [];
        $previousSum = 0;
        foreach ($this->sumByDate as $sumDate => $sumUah) {
            if ($date === null || $sumDate == $date) {
                $finance = new Finance();
                $finance->date = $sumDate;
                $finance->sumUah = $sumUah;
                $finance->sumUsd = Rate::getSumUsd($sumUah, ResourceRate::UAH);
                $finance->difference = $sumUah - $previousSum;
                $previousSum= $sumUah;

                $finances[] = $finance;
            }
        }

        return $finances;
    }
}

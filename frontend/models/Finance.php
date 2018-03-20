<?php

namespace frontend\models;

use frontend\models\finance\Rate;
use frontend\models\resource\finance\Rate as RateResource;
use yii\base\Model;

class Finance extends Model
{
    public $date;
    public $sumUah;
    public $sumUsd;
    public $difference;
}

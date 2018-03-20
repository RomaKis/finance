<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */


use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\finance\Rate;
use frontend\models\resource\finance\Rate as RateResource;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
$finances = [];
$diff = 0;
foreach (\frontend\models\resource\Finance::find()->all() as $model) {
    $finance = new \frontend\models\Finance();
    $finance->date = $model->getAttribute('date');
    $finance->sumUah = $model->getAttribute('sum_uah');
    $finance->sumUsd = Rate::getSumUsd($model->getAttribute('sum_uah'), RateResource::UAH);
    $finance->difference = $model->getAttribute('sum_uah') - $diff;

    $finances[] = $finance;
}

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $finances,
]);
?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'date',
            [
                'header' => 'Sum <b>UAH</b>',
                'attribute' => 'sumUah',
            ],
            [
                'header' => 'Sum <b>USD</b>',
                'attribute' => 'sumUsd',
            ],
            [
                'class' => ActionColumn::className(),
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['finance/details/show', 'date' => $model->date]);
                }
            ],
            [
                'header' => 'Diff with last',
                'attribute' => 'difference',
            ],
        ]
    ]);
    ?>
</div>

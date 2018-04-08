<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $models Details[] */

use frontend\models\finance\Details;
use frontend\models\finance\Rate;
use frontend\models\resource\finance\Rate as ResourceRate;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Details';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => $models,
]);
$gridColumns = [
    [
        'attribute' => 'userId',
    ],
    [
        'attribute' => 'stockName',
    ],
    [
        'attribute' => 'sourceName',
    ],
    [
        'class' => kartik\grid\EditableColumn::className(),
        'attribute' => 'sum',
        'editableOptions'=> function ($model, $key, $index, $widget) {
            return [
                'afterInput' => Html::hiddenInput('id', $model->id),
            ];
        }
    ],
    [
        'class' => kartik\grid\EditableColumn::className(),
        'attribute' => 'currency',
        'editableOptions'=> function ($model, $key, $index, $widget) {
            return [
                'afterInput' => Html::hiddenInput('id', $model->id),
            ];
        }
    ],
    [
        'class' => kartik\grid\EditableColumn::className(),
        'attribute' => 'isActive',
        'editableOptions'=> function ($model, $key, $index, $widget) {
            return [
                'afterInput' => Html::hiddenInput('id', $model->id),
            ];
        }
    ],
    [
        'class' => kartik\grid\EditableColumn::className(),
        'attribute' => 'date',
        'editableOptions'=> function ($model, $key, $index, $widget) {
            return [
                'afterInput' => Html::hiddenInput('id', $model->id),
            ];
        }
    ],
    [
        'class' => ActionColumn::className(),
        'header' => 'Actions',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{delete}',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to(['finance/details/delete', 'id' => $model->id]);
        }
    ],
];
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns
]);


$sum = 0;
$activeSum = 0;
foreach ($models as $model) {
    $localSum = 0;
    $currency = $model->currency;
    if ($currency === ResourceRate::UAH) {
        $localSum  = $model->sum;
    } else {
        $localSum = Rate::getSumUah($model->sum, $currency);
    }

    $sum += $localSum;
    if ($model->isActive) {
        $activeSum += $localSum;
    }
}
$sumUsd = Rate::getSumUsd($sum, ResourceRate::UAH);
$activeSumUsd = Rate::getSumUsd($activeSum, ResourceRate::UAH);

$result = [
    'Sum UAH:' => $sum,
    'Sum USD:' => $sumUsd,
    '__Active sum UAH:__' => $activeSum,
    '__Active sum USD:__' => $activeSumUsd,
];

echo '<table class="table-bordered">';
foreach ($result as $label => $value) {
    echo '<tr>';
    echo '<td>';
    echo Html::label($label);
    echo '</td>';
    echo '<td>';
    echo Html::label($value);
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

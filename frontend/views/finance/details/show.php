<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $models Details[] */

use frontend\models\finance\Details;
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

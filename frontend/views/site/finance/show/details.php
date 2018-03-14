<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Details */

use frontend\models\finance\Details;
use frontend\models\finance\NameByIdProvider;
use frontend\models\resource\finance\Details as ResourceDetails;
use yii\grid\GridView;

$dataProviderSum = new \yii\data\ArrayDataProvider([
    'allModels' => Details::getGroupedByDate()->getSumByDate(Yii::$app->request->get('date')),

]);

$gridViewSum =  GridView::widget([
    'dataProvider' => $dataProviderSum,
    'summary' => '',
    'columns' => [
        [
            'header' => 'Sum <b>UAH</b>',
            'attribute' => 'sumUah',
        ],
        [
            'header' => 'Sum <b>USD</b>',
            'attribute' => 'sumUsd',
        ],
    ]
]);

$dataProvider = new \yii\data\ArrayDataProvider([
    'allModels' => ResourceDetails::findIdentitiesByDate(Yii::$app->request->get('date')),

]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'columns' => [
        'id',
        'user_id',
        [
            'label' => 'Stock Name',
            'value' => function ($model) {
                $nameById = new NameByIdProvider();

                return $nameById->getStockNameById($model->getAttribute('stock_id'));
            }
        ],
        [
            'label' => 'Source Name',
            'value' => function ($model) {
                $nameById = new NameByIdProvider();

                return $nameById->getSourceNameById($model->getAttribute('source_id'));
            }
        ],
        [
            'attribute' => 'sum',
            'footer' => $gridViewSum
        ],
        'currency',
        'is_active',
        'date',
    ]
]);
?>

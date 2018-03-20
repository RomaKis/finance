<?php

use frontend\models\finance\NameByIdProvider;
use frontend\models\resource\finance\Source;
use frontend\models\resource\finance\Stock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Add Source';
$this->params['breadcrumbs'][] = $this->title;
/** @var \frontend\models\finance\Source $model */
?>
<div class="add-source">
    <h3>Existing Sources</h3>
    <?php
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => Source::find()->all(),
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'stock_id',
            [
                'label' => 'Stock Name',
                'value' => function ($model) {
                    $nameById = new NameByIdProvider();
                    return $nameById->getStockNameById($model->getAttribute('stock_id'));
                }
            ],
            'name',
        ]
    ]);
    ?>
    <h3>Add Source</h3>

    <?php $form = ActiveForm::begin(['id' => 'source-form']); ?>

    <?php
    $selectArray = [];
    foreach (Stock::find()->all() as $stock) {
        $selectArray[$stock->getAttribute('id')] = $stock->getAttribute('name');
    }
    ?>
    <?= $form->field($model, 'stockId')->dropDownList($selectArray) ?>

    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'source-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

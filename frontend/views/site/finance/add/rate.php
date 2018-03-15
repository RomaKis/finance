<?php

use frontend\models\resource\finance\Rate;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Add Rate';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="add-rate">
    <h3>Existing Rates</h3>
    <?php
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => Rate::find()->all(),

    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
    ]);
    ?>
    <h3>Add Rate</h3>

    <?php $form = ActiveForm::begin(['id' => 'rate-form']); ?>

    <?= $form->field($model, 'currency')->dropDownList(
        [Rate::UAH => Rate::UAH, Rate::USD => Rate::USD, Rate::EUR => Rate::EUR]
    ) ?>

    <?= $form->field($model, 'coefficient')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'rate-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

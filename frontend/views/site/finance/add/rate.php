<?php

use frontend\models\resource\finance\Rate;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="add-rate">
    <h3>Existing Stocks</h3>
    <table border="1" width="100%">
        <tr>
            <td>
                Id
            </td>
            <td>
                Currency
            </td>
            <td>
                Coefficient
            </td>
        </tr>
        <?php foreach (Rate::find()->all() as $existModel) {?>
            <tr>
                <?php foreach ($existModel->attributes as $attribute) { ?>
                        <td>
                            <?php echo $attribute; ?>
                        </td>
                    <?php
                } ?>
            </tr>
            <?php
        } ?>
    </table>
    <br>
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

<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model FinanceForm */

use frontend\models\FinanceForm;
use yii\helpers\Html;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="finance-table">
        <tr>
            <td>
                Id
            </td>
            <td>
                User id
            </td>
            <td>
                Stock
            </td>
            <td>
                Source
            </td>
            <td>
                Sum
            </td>
            <td>
                Currency
            </td>
        </tr>
        <?php foreach (FinanceForm::findIdentitiesByUserId(1) as $financeModel) { ?>
            <tr>
                <?php foreach ($financeModel->attributes as $attribute) { ?>
                    <td>
                        <?php echo $attribute; ?>
                    </td>
                <?php } ?>
            </tr>

        <?php } ?>
        </tr>
    </table>
</div>

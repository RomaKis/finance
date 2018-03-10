<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Finance */

use frontend\models\Finance;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Finance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finances">
    <h1><?= Html::encode($this->title) ?></h1>
    <table border="1" width="100%">
        <tr>
            <td>
                Date
            </td>
            <td>
                Sum UAH
            </td>
            <td>
                Sum USD
            </td>
            <td>
            </td>
        </tr>
        <?php foreach (Finance::find()->all() as $financeModel) {
            $id = null; ?>
            <tr>
                <?php foreach ($financeModel->attributes as $key => $attribute) { ?>
                <?php if ($key != 'id') { ?>
                    <td>
                        <?php echo $attribute; ?>
                    </td>
                <?php } else {
                    $id = $attribute;
                    }
                } ?>
                <td>
                    <?php echo $attribute/26; ?>
                </td>
                <td>
                    <a href="<?php echo Url::to(['finance-details', 'id' => $id])?>">
                        Show  details
                    </a>
                </td>
            </tr>
            <?php
        } ?>
    </table>
</div>

<?php

namespace frontend\controllers\finance;

use frontend\controllers\AccessLoginOnly;
use frontend\models\finance\Details;
use Yii;
use yii\helpers\Json;
use frontend\models\resource\finance\Details as ResourceDetails;


class DetailsController extends AccessLoginOnly
{
    public function actionAdd()
    {
        $model = new Details();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model = new Details();
        }
        $model->isActive = true;

        return $this->render('add', ['model' => $model]);
    }

    public function actionShow()
    {
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('id');
            $details = Yii::$app->request->post('Details');
            /** @var Details $detail */
            $detail = reset($details);
            $resourceDetail = ResourceDetails::findIdentity($id);
            $resourceDetail->setAttributes($detail);
            $resourceDetail->save();
            $out = Json::encode(['output' => reset($detail), 'message' => '']);

            echo $out;

            return;
        }

        $date = Yii::$app->request->get('date');
        $models = Details::findIdentitiesByDate($date);
        return $this->render('show', ['models' => $models]);
    }

    public function actionDelete()
    {
        $id = Yii::$app->request->get('id');
        $resourceDetail = ResourceDetails::findIdentity($id);
        $date = $resourceDetail->getAttribute('date');
        $resourceDetail->delete();

        $models = Details::findIdentitiesByDate($date);

        return $this->render('show', ['models' => $models]);
    }
}

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= !Yii::$app->user->isGuest ?Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : ''; ?>
    </p>

    <?=yii\widgets\DetailView::widget([
      'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email'
        ],
    ]);?>
</div>

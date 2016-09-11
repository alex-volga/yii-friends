<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Friends;

/* @var $this yii\web\View */

$this->title = 'Profile';
?>
<div class="site-index">
  <?php Pjax::begin(); ?>
  <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'username',
        'email',
        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{view} {add-friend}',
          'buttons' => [
            'add-friend' => function ($url, $model) {
                if ($model->id != Yii::$app->getUser()->id && !Friends::isMy($model->id)) {
                  return Html::a(
                    '<span class="glyphicon glyphicon-heart-empty"></span>',
                    $url,
                    [
                      'title' => Yii::t('app', 'Add to friends'),
                    ]
                  );
                } else {
                  return '';
                }
            }          ],
        ],
        ],
  ]);?>
  <?php Pjax::end(); ?>
</div>

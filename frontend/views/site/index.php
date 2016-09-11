<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Friends;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
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
        'template' => '{view} {add-friend}{remove-friend} {delete}',
        'buttons' => [
          'delete' =>  function ($url, $model) {
              return !Yii::$app->user->isGuest && $model->id != Yii::$app->getUser()->id ? Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                 'class' => '',
                 'data' => [
                     'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                     'method' => 'post',
                 ],
             ]) : '';
          },
          'add-friend' => function ($url, $model) {
              if (!Yii::$app->user->isGuest && $model->id != Yii::$app->getUser()->id && !Friends::isMy($model->id)) {
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
          },
          'remove-friend' => function ($url, $model) {
              if (!Yii::$app->user->isGuest && $model->id != Yii::$app->getUser()->id && Friends::isMy($model->id)) {
                return Html::a(
                  '<span class="glyphicon glyphicon-heart"></span>',
                  $url,
                  [
                    'title' => Yii::t('app', 'Remove from friends'),
                  ]
                );
              } else {
                return '';
              }
          }
        ],
      ],
      ],
]);?>
<?php Pjax::end(); ?>
</div>

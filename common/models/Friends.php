<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%friends}}".
 *
 * @property integer $user_id
 * @property integer $friend_id
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friends}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['friend_id'], 'required'],
            [['user_id', 'friend_id'], 'integer'],
            [['friend_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['friend_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
       return [
           [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false
           ]
       ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'friend_id' => 'Friend ID',
        ];
    }

    public function getFriend()
    {
        return $this->hasOne(User::className(), ['friend_id' => 'id']);
    }

    public static function isMy($id)
    {
      return self::find()->where(['user_id' => Yii::$app->getUser()->id])->andWhere(['friend_id' => $id])->exists();
    }

    public static function getAllMyPotentialFriends()
    {
      $subQuery = (new \yii\db\Query())->select('friend_id')->from('friends')->where(['user_id' => Yii::$app->getUser()->id]);
      return User::find()
          ->join('LEFT JOIN', 'friends', 'user.id = friends.user_id')
          ->where(['friends.friend_id' => Yii::$app->getUser()->id])
          ->andWhere(['not', ['in', 'friends.user_id', $subQuery]]);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date_start
 * @property string $repeat_type
 * @property string $email
 * @property int $use_notification
 * @property int $is_blocked
 * @property string $date_created
 * @property int $user_id
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'date_start', 'repeat_type', 'user_id'], 'required'],
            [['description'], 'string'],
            [['date_start', 'date_created'], 'safe'],
            [['use_notification', 'is_blocked', 'user_id'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['repeat_type'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'date_start' => Yii::t('app', 'Date Start'),
            'repeat_type' => Yii::t('app', 'Repeat Type'),
            'email' => Yii::t('app', 'Email'),
            'use_notification' => Yii::t('app', 'Use Notification'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'date_created' => Yii::t('app', 'Date Created'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}

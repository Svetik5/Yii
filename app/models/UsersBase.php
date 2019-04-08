<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $token
 * @property string $date_add
 *
 * @property Activity[] $activities
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'auth_key'], 'required'],
            [['date_add'], 'safe'],
            [['email', 'password_hash', 'token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['token'], 'unique'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'token' => Yii::t('app', 'Token'),
            'date_add' => Yii::t('app', 'Date Add'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['user_id' => 'id']);
    }
}
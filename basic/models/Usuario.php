<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $nome_completo
 * @property double $latitude
 * @property double $longitude
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['username'], 'string', 'max' => 16],
            [['password'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 255],
            [['nome_completo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'nome_completo' => 'Nome Completo',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}

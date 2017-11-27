<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property integer $idProduto
 * @property string $nome
 * @property integer $preco
 * @property string $descricao
 * @property integer $Categoria_idCategoria
 *
 * @property Categoria $categoriaIdCategoria
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'preco', 'Categoria_idCategoria'], 'required'],
            [['preco', 'Categoria_idCategoria'], 'integer'],
            [['nome'], 'string', 'max' => 45],
            [['descricao'], 'string', 'max' => 250],
            [['Categoria_idCategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['Categoria_idCategoria' => 'idCategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProduto' => Yii::t('app', 'Id Produto'),
            'nome' => Yii::t('app', 'Nome'),
            'preco' => Yii::t('app', 'Preco'),
            'descricao' => Yii::t('app', 'Descricao'),
            'Categoria_idCategoria' => Yii::t('app', 'Categoria'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'Categoria_idCategoria']);
    }
}

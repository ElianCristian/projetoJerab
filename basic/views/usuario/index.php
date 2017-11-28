<?php

use yii\helpers\Html;
use yii\grid\GridView;



/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">
	<?= Yii::$app->session->getFlash('error'); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            'email:email',
            'nome_completo',
            // 'latitude',
            // 'longitude',
			
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
		
	?>
</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersRoles */

$this->title = 'Create Users Roles';
$this->params['breadcrumbs'][] = ['label' => 'Users Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

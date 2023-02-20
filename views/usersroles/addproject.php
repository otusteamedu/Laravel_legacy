<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UsersRoles */

$this->title = 'Добавление проектов для персональной роли';

?>
<div style='width:500px;'>
<div class="users-roles-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_formaddprojects', [
        'model' => $model,
        'rolesArray' => $rolesArray,
        'projectsArray'=>$projectsArray,
        '$personal_role_id'=>$personal_role_id,
    ]) ?>

</div>
    </div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->label('Название Роли') ?>
     <?= $form->field($model, 'Description')->textInput(['maxlength' => true])->label('Описание  Роли') ?>
    <?php 

echo "<ul class='tree' id='jst'>"; //main start
 foreach ($a['projects'] as $key=>$value){
 
     echo "<li style='font-size:22px;'>".$value.""; // project begin
      echo "<ul>";      // products begin
     foreach ($a['products'] as $key1=>$value1){
         
        if ($key==$value1['Project_ID']){
           
         echo "<li style='margin-left:20px; font-size:18px;'>".'  '.$value1['Name'].""; //product begin
                     echo "<ul>";    //modules begin 
                  
          foreach ($a['modules'] as $key2=>$value2){
               
               if ($key1==$value2['Product_ID']){
       
                    echo "<li style='margin-left:40px;font-size:14px;'>".'  '.$value2['Name'].""; //module begin
                     // foreach ($a['accesses'] as $key3=>$value3){ 
                   //     echo "fgdgfdgdfg";
                     //   var_dump($a['accesses']);
                       //   echo "<div style='color:red'>".$a['accesses']['Module_ID']."</div>";
                             
                   echo Html::label("нет прав");
                   echo "<input type='radio' name='access[$key2]' value='0'> ";
                    echo Html::label("просмотр");
                   echo "<input type='radio' name='access[$key2]' value='1'> ";
                    echo Html::label("просмотр и создание");
                  echo "<input type='radio' name='access[$key2]' value='2'> ";
                    echo Html::label("просмотр и редактирование");
                  echo "<input type='radio' name='access[$key2]' value='3'> ";
                    echo Html::label("полный доступ");
                  echo "<input type='radio' name='access[$key2]' value='4'> ";
                   
                          
                    //  }
             //  }
               echo "</li>"; //module end
               
          }
          
        }
        echo "</ul>"; //modules end
        echo "</li>"; //product end
               
     }
    
 }
  echo "</ul>"; //products end
 echo "</li>"; //project end
 }
 echo "</ul>"; // main end
 //foreach ($a['products']['Project_ID'] as $key=>$value){
 
   //  echo "<p>".$value."</p>";
 //}
?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var tree = document.getElementById('jst');

    var treeLis = tree.getElementsByTagName('li');

    /* wrap all textNodes into spans */
    for (var i = 0; i < treeLis.length; i++) {
      var li = treeLis[i];

      var span = document.createElement('span');
      li.insertBefore(span, li.firstChild);
      span.appendChild(span.nextSibling);
    }

    /* catch clicks on whole tree */
    tree.onclick = function(event) {
      var target = event.target;

      if (target.tagName != 'SPAN') {
        return;
      }

      /* now we know the SPAN is clicked */
      var childrenContainer = target.parentNode.getElementsByTagName('ul')[0];
      if (!childrenContainer) return; // no children

      childrenContainer.hidden = !childrenContainer.hidden;
    }
  </script>
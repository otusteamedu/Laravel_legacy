<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Access */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accesses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


            
<div class="access-view">
<?= $this->render('_admin');?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Role_id',
            'Module_ID',
            'Allow_View',
            'Allow_Edit',
            'Allow_Create',
        ],
    ]) ?>
    
   <div class="access-form">

    <?php $form = ActiveForm::begin(); ?>

 

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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
                      foreach ($a['accesses'] as $key3=>$value3){ 
                        
                           if ($key2==$value3['Module_ID']){   
                             
                              // echo "<p style='margin-left:60px'>".$key3.'  '.$value3['Allow_Create']."</p>";
                           // echo  "<span>".$form->field($model, 'Allow_View')->checkbox();
                             //echo   $form->field($model, 'Allow_Edit')->checkbox();
                               //echo   $form->field($model, 'Allow_Create')->checkbox();
                               //echo "</span>";
                               echo "";
                             echo Html::label("Allow_View");   //allows
                             echo "&nbsp;";echo "&nbsp;";echo "&nbsp;";
                             if ($value3['Allow_View']==1){
                             echo Html::checkbox("Allow_View", true);
                             }
                             else{
                                 echo Html::checkbox("Allow_View", false);
                             }
                              echo "&nbsp;";echo "&nbsp;";echo "&nbsp;";
                             echo Html::label("Allow_Edit");
                             echo "&nbsp;";echo "&nbsp;";echo "&nbsp;";
                              if ($value3['Allow_Edit']==1){
                             echo Html::checkbox("Allow_Edit", true);
                              }
                              else{
                                  echo Html::checkbox("Allow_Edit", false);
                              }
                               echo "&nbsp;";echo "&nbsp;";echo "&nbsp;";
                             echo Html::label("Allow_Create");
                             echo "&nbsp;";echo "&nbsp;";echo "&nbsp;";
                              if ($value3['Allow_Create']==1){
                             echo Html::checkbox("Allow_Create", true);
                           }
                           else{
                               echo Html::checkbox("Allow_Create", false);
                           }
                          
                      }
               }
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
</div>
<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
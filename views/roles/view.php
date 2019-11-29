<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Roles */
$this->beginContent('@app/views/layouts/admin.php'); 

 $this->endContent(); 
$this->title = $model->Name;

?>

<div class="roles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Role_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Role_ID], [
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
            'Role_ID',
            'Name',
            'Description',
        ],
    ]) ?>

</div>

    <?php 
  
if (!empty($a['accesses'])){
                   foreach ($a['accesses'] as $key=>$value){
                       
                      $module_levelRights[$value['Module_ID']]=$value['Level_Rights'];
                     
                      
                       
                   }
}
        foreach ($a['projects'] as $key=>$value){ 
           
        foreach ($a['products'] as $key1=>$value1){
        
        if ($key==$value1['Project_ID']){
            
            foreach ($a['modules'] as $key2=>$value2){
           
               if ($key1==$value2['Product_ID']){
                
                   if ($module_levelRights[$key2]>0){
                       
                       $proj[$key]=1;
                   $prod[$key1]=1;
                   
                   }
               }
        }
        }
    }
    }

echo "<ul class='tree' id='jst'>"; //main start
 foreach ($a['projects'] as $key=>$value){
 if($proj[$key]==1){ 
     echo "<li style='font-size:22px;'>".$value.""; // project begin
 }    
      echo "<ul hidden>";      // products begin
     foreach ($a['products'] as $key1=>$value1){
         
        if ($key==$value1['Project_ID']){
            if ($prod[$key1]==1){ 
         echo "<li style='margin-left:20px; font-size:18px;'>".'  '.$value1['Name'].""; //product begin
            }
                     echo "<ul hidden>";    //modules begin 
          foreach ($a['modules'] as $key2=>$value2){
               
               if ($key1==$value2['Product_ID']){
                     if ($module_levelRights[$key2]>0){
                    echo "<li style='margin-left:40px;font-size:14px;'>".'  '.$value2['Name'].""; //module begin
                     }
                    if (!empty($a['accesses'])){
                      foreach ($a['accesses'] as $key3=>$value3){ 
                        
                            if ($key2==$value3['Module_ID']){   
                       
                                  
                   switch ($value3['Level_Rights']) {
                        case 1:
                            echo "---просмотр---";
                            break;
                        case 2:
                            echo "----просмотр и создание----";
                            break;
                        case 3:
                            echo "----просмотр и редактирование---";
                            break;
                        case 4:
                            echo "---полный доступ----";
                            break;
                        }
                   
                          
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
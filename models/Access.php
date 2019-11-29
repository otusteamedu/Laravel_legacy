<?php

namespace app\models;

use Yii;
use app\models\Projects;
use app\models\ProjectsQuery;
use app\models\Products;
use app\models\ProductcsQuery;
use app\models\UsersRoles;
use app\models\UsersRolesQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Access".
 *
 * @property string $id
 * @property string $Role_id
 * @property string $Module_ID
 * @property integer $Level_Rights

 */
class Access extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Access';
    }
    
    public static function isAdmin(){

      
        if(Yii::$app->user->getIdentity()->username != 'admin'){
            echo "not access";
           exit;
        }

    }
    
    
     public static function calculationDatetaskOLD($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end ){
     
     $not_generate='0';
     $today = date("Y-m-d H:i:s");  
     
     if ($today>$date_end){
         return $not_generate;
     }
      if ($today<$date_start){
         return $not_generate;
     }
     if(!empty($years)){
         $year=min($years);
         $year_now=date("Y");
         if ($year<$year_now){
            return $not_generate; 
         }
     }
     else {
         $year=0;
     }
     if(!empty($months)){
         $month=min($months);
     }
     else {
         $month=0;
     }
     if(!empty($days_of_week)){
         $day_of_week=min($days_of_week);
     }
     else {
         $day_of_week=0;
     }
     
     if(!empty($dates)){
         $date=min($dates);
     }
     else {
         $date=0;
     }
     if ($month_check==1){
         
     }
     else{
         
     }
   $time = new \DateTime('now', new \DateTimeZone('UTC'));
  echo date_format($time, 'Y-m-d H:i:s'); // 2011-03-03 00:00:00
  $time = new \DateTime('06/31/2011');

  
  echo date_format($time, 'Y-m-d H:i:s'); // 2011-07-01 00:00:00
    // $date_new_task=('2016-06-24 16:25:00');
     return $date_new_task;
    }
    
    
    
      public static function calculationDatetaskold2($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end, $datetimelasttask ){
     
     $all_dates=0;
     $all_days_of_week=0;
     $all_years=0;
     $all_months=0;
     
     $today = date("Y-m-d");  
     $time_now=date('H:i');
   
    // sort($times); 
    
     $dateplus=0; //added days 
     
     
     
     foreach ($times as $key=>$value){

         if ($time_now<$value){
             $time_task=$value;
             break;
         }
         else {
             $time_task=min($times);
             //$dateplus=1;
         }
     }
     

    $pieces = explode(":",  $time_task);
     $hours=$pieces[0]; // hours
     $minutes=$pieces[1]; // minutes
     $pieces = explode("-",  $today);
     $year_now=$pieces[0]; // year_now
     $month_now=$pieces[1]; // month_now
     $date_now=$pieces[2]; // date_now
    // echo $month_now;
     
     $date_now=$date_now+$datelus;
     
     if (!empty($dates)){
          sort($dates);
         foreach ($dates as $key=>$value){

         if ($date_now==$value){ //task for today
             $date_task=$value;
             break;
         }
        else{
            $date_task=$value;
            
            $time_task=min($times);
         }
     }
     }
     else{
         $alldates=1;
     }
     
      if (!empty($months)){
          sort($months);
         foreach ($months as $key=>$value){

         if ($month_now<=$value){ //task for today
             $month_task=$value;
              $year_task=2016;
             break;
         }
        else{
             $year_task=2017;
            $month_task=$value;
            
            $date_task=min($dates);
            $time_task=min($times);
         }
     }
     }
     else{
         $allmonths=1;
     }
     
 /*    if (!empty($years)){
          sort($years);
         foreach ($years as $key=>$value){

         if ($year_now==$value){ //task for today
             $year_task=$value;
             break;
         }
        else{
            
            $month_task=min($months);
            
            $date_task=min($dates);
            $time_task=min($times);
         }
     }
     }*/
     
      if (!empty($years)){
          sort($years);
         foreach ($years as $key=>$value){

         if ($year_now==$value){ //task for today
             $year_task=$value;
             break;
         }
        else{
            if (!empty($months)){
            $month_task=min($months);
            }
             if (!empty($dates)){
            $date_task=min($dates);
             }
             if (!empty($times)){
            $time_task=min($times);
             
         }
     }
     }
      }
      
     
     $year_task=2016;
   /*  echo $year_task;
     echo "<hr>y";
     echo $month_task;
     echo "<hr>m";
     echo $date_task;
     echo "<hr>d";*/

//echo $dateplus;
//echo $hours;
//echo $minutes;
   
     if(!isset($dateplus)){
         $dateplus=0;
     }
     

     $time = new \DateTime($today, new \DateTimeZone('Europe/Minsk'));
     $time->setDate($year_task, $month_task, $date_task);
     $interval = new \DateInterval("P0Y0M".$dateplus."DT".$hours."H".$minutes."M0S");   
     $time->add($interval);
     $date_new_task=$time->format("Y-m-d H:i:s");
   
     
     if(($today>$date_end)){
         
         $date_new_task=null;
     }
     
     return $date_new_task;
    
      }
      
      
      public static function calculationDatetaskwork($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end, $datetimelasttask ){
     
          
          
     $all_dates=0;
     $all_days_of_week=0;
     $all_years=0;
     $all_months=0;
     
     $today = date("Y-m-d");  
     $time_now=date('H:i');
   
     $pieces = explode("-",  $today);
     $year_now=$pieces[0]; // year_now
     $month_now=$pieces[1]; // month_now
     $date_now=$pieces[2]; // date_now
     
     sort($times); 
    
    foreach ($times as $key=>$value){

         if ($time_now<$value){
             $time_task=$value;
             $day_add=0;
             break;
         }
         else {
             $time_task=min($times);
             $day_add=1;       
         }
     }
    
     if($all_dates==0 && $all_days_of_week==0 && $all_years==0 && $all_months==0){
     $time = new \DateTime($time_task, new \DateTimeZone('Europe/Minsk'));
     $interval = new \DateInterval("P0Y0M".$day_add."DT0H0M0S");
     $time->add($interval);
     }
     //$time->setDate($year_task, $month_task, $date_task);
     
     if (!empty($dates)){
         sort($dates);
          foreach ($dates as $key=>$value){
              if($date_now==$value){
                  $date_task=$date_now;
              }
              else{
                  $date_task=min($dates);
              }
          }
          
     }
     
     $date_new_task=$time->format("Y-m-d H:i:s");
      
     
      
     return $date_new_task;
    
      }
      
      
       public static function calculationDatetask4($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end, $datetimelasttask ){
     
     $today = date("Y-m-d");  
     $time_now=date('H:i');
   
     $pieces = explode("-",  $today);
     $year_now=$pieces[0]; // year_now
     $month_now=$pieces[1]; // month_now
     $date_now=$pieces[2]; // date_now
           
           
           
      sort($times); 
    if(!empty($times)){
      foreach ($times as $key=>$value){

         if ($time_now<$value){
             $time_task=$value;
            
             break;
         }
         else {
             $time_task=min($times);
                    
         }
     }
    }   
     
      $pieces = explode(":",  $time_task);
     $hour_task=$pieces[0]; 
     $minute_task=$pieces[1]; 
    
      if(!empty($dates)){
      foreach ($dates as $key=>$value){

         if ($date_now<=$value){
             $date_task=$value;
            
             break;
         }
         else {
             $date_task=min($dates);
                    
         }
      }
      }
      else
          {
          $date_task=$date_now;
          }
      
         
      if(!empty($months)){
      foreach ($months as $key=>$value){

         if ($month_now<=$value){
             $month_task=$value;
            
             break;
         }
         else {
             $month_task=min($months);
                    
         }
     }
      }
      else{
          $month_task=$month_now;
      }
     
       if(!empty($years)){
      foreach ($years as $key=>$value){

         if ($year_now<=$value){
             $year_task=$value;
            
             break;
         }
         else {
             $year_task=min($years);
                    
         }
     }
       }
       else{
            $year_task=$year_now;
       }
     
     if(!empty($days_of_week)){
      foreach ($days_of_week as $key=>$value){

         $days_of_week_for_task=date("w", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
         if (in_array($days_of_week_for_task, $days_of_week)){
            return $date_new_task;
            
         }   
         else{
             
         }
           
      }
      }
      else
          {
          
          }
     
     echo $date_new_task= date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
     echo date("w", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
     exit;
     return $date_new_task;
    
      }
      
      
      
         public static function calculationDatetask05082016($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end, $datetimelasttask ){
     
     $today = date("Y-m-d");  
     $time_now=date('H:i');
   
    // if(!empty($date_start)){
    //     $today=date("Y-m-d", $date_start);
    // }
     
   
     
     $pieces = explode("-",  $today);
     
     $year_now=$pieces[0]; // year_now
     $month_now=$pieces[1]; // month_now
     $date_now=$pieces[2]; // date_now
       //echo $month_now;
     $year_min= $year_now;
     $month_min= $month_now;
     $date_min=$date_now;
           
      sort($times); 
    if(!empty($times)){
      foreach ($times as $key=>$value){

         if ($time_now<$value){
             $time_task=$value;
             
             if (empty($dates) && empty($months) && empty($years) && empty($days_of_week)){
                 $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_now, $date_now, $year_now));
                 if ($date_new_task<$today){
                    // return null;
                 }
                 return $date_new_task; // if we have only time
             }
             
             break;
         }
         else {
             $time_task=min($times);
             $pieces = explode(":",  $time_task);
             $hour_task=$pieces[0]; 
             $minute_task=$pieces[1]; 
             $date_min=$date_min+1;   
             if (empty($dates) && empty($months) && empty($years) && empty($days_of_week)){
                 $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_now, $date_min, $year_now));
                 if ($date_new_task<$today){
                   //  return null;
                 }
                 return $date_new_task; // if we have only time
             }
         }
         
         $pieces = explode(":",  $time_task);
         $hour_task=$pieces[0]; 
         $minute_task=$pieces[1]; 
         $ok=0;$i=0;
         while($ok!=1 && $i<5){ // check for our date in array of days of week
         
       $i++;
         if(!empty($dates)) { 
                 
               
                foreach ($dates as $key=>$value){

                   if ($date_min<=$value){
                       $date_task=$value;
                       
                   if (empty($months) && empty($years) && empty($days_of_week)){
                 $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_min, $date_task, $year_now));
                 if ($date_new_task<$today){
                    // return null;
                 }
                 return $date_new_task; // if we have only time and date
                    }

                       break;
                   }
                   else {
                       $date_task=min($dates);
                       $month_min=$month_min+1;
                      
                        if (empty($months) && empty($years) && empty($days_of_week)){
                        $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_min, $date_task, $year_now));
                        if ($date_new_task<$today){
                            // return null;
                         }
                        return $date_new_task; // if we have only time and date
                    }


                   }
                }
      
            // echo $month_min;
         }
         else { //empty date
             
             $date_task=$date_min;
         }
         
          if(!empty($months)){
            foreach ($months as $key=>$value){

               if ($month_min<=$value){
                   $month_task=$value;
                   
                   if (empty($years) && empty($days_of_week)){
                    $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_min));
                    if ($date_new_task<$today){
                   //  return null;
                     }
                    return $date_new_task; // if we have only time and date
                       }

                       break;

                   
               }
               else {
                   $month_task=min($months);
                   $year_min=$year_min+1;
                    if (empty($years) && empty($days_of_week)){
                    $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_min));
                    if ($date_new_task<$today){
                    // return null;
                     }
                    return $date_new_task; // if we have only time and date
                       }
               }
           }
      }
      else {
          $month_task=$month_min;
      }
    
         if(!empty($years)){
            foreach ($years as $key=>$value){

               if ($year_min<=$value){
                   $year_task=$value;
                   
                   if (empty($days_of_week)){
                    $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
                    if ($date_new_task<$today){
                    // return null;
                 }
                    return $date_new_task; // if we have only time and date
                    }

                       break;
                   
                  
               }
               else {
                   return null;
                   $year_task=min($years);
                   
                   if (empty($days_of_week)){
                    $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
                    if ($date_new_task<$today){
                    // return null;
                 }
                    return $date_new_task; // if we have only time and date
                    }

               }
           }
       }
       else {
          $year_task=$year_min;
      }
         
     }
  
      if(!empty($days_of_week)){
      foreach ($days_of_week as $key=>$value){


         $days_of_week_for_task=date("w", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));

         if (in_array($days_of_week_for_task, $days_of_week)){
            $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
            if ($date_new_task<$today){
                    // return null;
                 }
            return $date_new_task;
            
         }   
         else{
         $year_min= $year_task;
         $month_min= $month_task;
          $date_min=$date_task;
       
          $ok=0;
         }
      }
           
      }
      }
     
    }     
    
    

   $date_new_task=date("Y-m-d H:i:s", mktime($hour_task, $minute_task, 0, $month_task, $date_task, $year_task));
    if ($date_new_task<$today){
                     return null;
                 }
     return $date_new_task;
    
      }
      
      
      
      
      
       public static function calculationDatetask($years, $months, $days_of_week, $dates, $everything, $month_check, $times, $date_start, $date_end, $datetimelasttask ){
           
         
           
   /*    $years=[
    ['id' => '2016', 'data' => '2016'],
    ['id' => '2017', 'data' => '2017'],
    ['id' => '2018', 'data' => '2018'],
    ['id' => '2019', 'data' => '2019'],
];
 //  $months=[
    //['id' => '1', 'data' => 'ЯНВ'],
    //['id' => '2', 'data' => 'ФЕВ'],
   // ['id' => '3', 'data' => 'МРТ'],
   // ['id' => '4', 'data' => 'АПР'],
    ['id' => '5', 'data' => 'МАЙ'],
   // ['id' => '6', 'data' => 'ИЮН'],
   // ['id' => '7', 'data' => 'ИЮЛ'],
  //  ['id' => '8', 'data' => 'АВГ'],
    //['id' => '9', 'data' => 'СЕН'],
   // ['id' => '10', 'data' => 'ОКТ'],
    ['id' => '11', 'data' => 'НОЯ'],
    //['id' => '12', 'data' => 'ДЕК'],
];
   
    $dates=[
   // ['id' => '1', 'data' => '1'],
    //['id' => '2', 'data' => '2'],
   // ['id' => '3', 'data' => '3'],
   // ['id' => '4', 'data' => '4'],
    ['id' => '5', 'data' => '5'],
    ['id' => '6', 'data' => '6'],
  //  ['id' => '7', 'data' => '7'],
   //  ['id' => '8', 'data' => '8'],
   // ['id' => '9', 'data' => '9'],
   // ['id' => '10', 'data' => '10'],
    ['id' => '11', 'data' => '11'],
    ['id' => '12', 'data' => '12'],
    ['id' => '13', 'data' => '13'],
    ['id' => '14', 'data' => '14'],
   // ['id' => '15', 'data' => '15'],
    ['id' => '16', 'data' => '16'],
    ['id' => '17', 'data' => '17'],
    ['id' => '18', 'data' => '18'],
    ['id' => '19', 'data' => '19'],
    ['id' => '20', 'data' => '20'],
    ['id' => '21', 'data' => '21'],
   // ['id' => '22', 'data' => '22'],
    ['id' => '23', 'data' => '23'],
    ['id' => '24', 'data' => '24'],
    ['id' => '25', 'data' => '25'],
    ['id' => '26', 'data' => '26'],
    ['id' => '27', 'data' => '27'],
    ['id' => '28', 'data' => '28'],
    ['id' => '29', 'data' => '29'],
    ['id' => '30', 'data' => '30'],
    ['id' => '31', 'data' => '31'],

];
   
    
      $days_of_week=[
   ['id' => '1', 'data' => 'ПН'],
    ['id' => '2', 'data' => 'ВТ'],
    ['id' => '3', 'data' => 'СР'],
    ['id' => '4', 'data' => 'ЧТ'],
    ['id' => '5', 'data' => 'ПТ'],
    ['id' => '6', 'data' => 'СБ'],
    ['id' => '7', 'data' => 'ВС'],

];*/
    
    if(empty($years)){
        $years=[
    '2016',
    '2017',
     '2018',
     '2019'
];
    }
    
    if(empty($days_of_week)){
    $days_of_week=[
1,2,3,4,5,6,7

];
    }
    
    if(empty($months)){
         $months=[
   1,2,3,4,5,6,7,8,9,10,11,12
];
    }
    if(empty($dates)){
         $dates=[
    1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31

];
    }
    
    
     $today_with_time=date("Y-m-d-H-i-s");
     $date_start=  date("Y-m-d-H-i-s", mktime(16, 12, 0, 8, 8, 2016));    
     if(!$date_end){
        $max_date_time=date("Y-m-d-H-i-s", mktime(16, 12, 0, 8, 9, 2021)); 
     }
     else{
      $max_date_time=date("Y-m-d-H-i-s", mktime(16, 12, 0, 8, 9, 2021)); 
     }
     if($date_start>$today_with_time){
         
         $min_date_time_task=$date_start;
         
         }
      else{
          
        $min_date_time_task= $today_with_time;
      }
     
         $year_min_task=min($years);  
    $date_new_task= $date_start;
     
       $i=0;
      while($date_new_task<$max_date_time){ //  ищем нужную дату всё время увеличивая её пока она не превысит дату максимальную
         if($i>25) return null;
         $i++;
          if($i<=25){
    
   // echo $min_date_time_task;
   // echo "<hr>";
     $pieces = explode("-",  $min_date_time_task);
     
     $year_min=$pieces[0]; 
     $month_min=(int)$pieces[1]; 
     $date_min=(int)$pieces[2]; 
     $hour_min=$pieces[3];
     $minute_min=$pieces[4]; 
    
     $time_min=date('H:i', mktime($hour_min, $minute_min));
    
     $min_time_founded=0;
     $min_month_founded=0;// while we founding time    
     $min_date_founded=0; // while we founding time    
     $next_day=0; //flag for add one day 
    
     sort($times); 
    if(!empty($times)){
      foreach ($times as $key=>$value){

      if($value>$time_min){
          
         $time_min_new=$value;
         $min_time_founded=1;
         break 1;
      }
             
    }
    if($min_time_founded==0){
         $time_min_new=min($times);
         $date_min=$date_min+1;// next day
         $next_day=1;
    }
    $time_min_task=$time_min_new; // время запуска
      }
    
          }
          if(!empty($dates)){
            // echo $date_min;
              sort($dates);
              foreach ($dates as $key=>$value){
               
                  if($value>=$date_min){
                      $date_min_new=$value;
                      $month_min_task=$month_min;
                      $min_date_founded=1;
                      break 1;
                  }
              }
              
              if($min_date_founded==0){
         $date_min_new=min($dates);
           $time_min_new=min($times);
         $month_min_task=$month_min+1;
        
    }
    $date_min_task=$date_min_new; // время запуска
       
          }
         
           if(!empty($months)){
               
              sort($months);
              foreach ($months as $key=>$value){
               //  echo "<hr>";
             // echo $month_min_task; echo $year_min_task; 
              //echo "<hr>";
                  if($value==$month_min_task){
                      $month_min_new=$value;
                      $min_month_founded=1;
                     // echo "bb";
                      break 1;
                  }
                  if($value>$month_min_task){
                     
                      $month_min_new=$value;
                      $date_min_task=min($dates);
                     // $year_min_task=$year_min+1;
                      $min_month_founded=1;
                      break 1;
                  }
                  
                  
              }
             // echo "<hr>";
              //echo $min_month_founded;
              //echo "<hr>";
              if($min_month_founded==0){
             $date_min_task=min($dates);     
         $month_min_new=min($months);
         $year_min_task=$year_min+1;
        
    }
    $month_min_task=$month_min_new; // время запуска
          
          }
        //  echo $year_min_task;
          
           if(!empty($years)){
               
              sort($years);
              foreach ($years as $key=>$value){
                 
                  if($value==$year_min_task){
                      $year_min_new=$value;
                      $min_year_founded=1;
                      break 1;
                  }
                   if($value>$year_min_task){
                      $year_min_new=$value;
                      $date_min_task=min($dates);
                      $month_min_task=min($months);
                      $min_year_founded=1;
                      
                      break 1;
                  }
                  
                     
                 
              }
              
             
      if ($min_year_founded==0){
          return null;
      }
        
    }
    $year_min_task=$year_min_new; // время запуска
          
          
          
     
      
      //$month_min=11;
      //$date_min=5;
     // $year_min=2016;
    // var_dump($time_min_task);
    
     $pieces = explode(":",  $time_min_task);
     $hour_min_task=$pieces[0];
     $minute_min_task=$pieces[1];
    // var_dump($month_min_task);
     //exit;
     $date_new_task=date("Y-m-d H:i:s", mktime($hour_min_task, $minute_min_task, 0, $month_min_task, $date_min_task, $year_min_task));
     
     $days_of_week_for_task=date("w", mktime($hour_min_task, $minute_min_task, 0, $month_min_task, $date_min_task, $year_min_task));
     //echo $days_of_week_for_task;
    // var_dump($days_of_week);
     
         
    
   // var_dump($keys);
     if (in_array($days_of_week_for_task, $days_of_week)){
      
         return $date_new_task;
     }
     else{
          
         $date_new_task1=date("Y-m-d-H-i-s", mktime($hour_min_task, $minute_min_task, 0, $month_min_task, $date_min_task+1, $year_min_task));
         $min_date_time_task=$date_new_task1;
     }
      }
      
    // $date_new_task=$date_new_task=date("Y-m-d H:i:s", mktime($hour_min_task, $minute_min_task, 0, $month_min_task, $date_min_task+1, $year_min_task));
     // return $date_new_task;
      }
      
    
      
      
      
      
      
      
      
    
     public static function generatePassword($number){

      $arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0');  
    // Генерируем пароль  
    $pass = "";  
    for($i = 0; $i < $number; $i++)  
    {  
      // Вычисляем случайный индекс массива  
      $index = rand(0, count($arr) - 1);  
      $pass .= $arr[$index];  
    }  
    return $pass;  

    }
    
     public static function show_tree_access2($user_id=NULL, $role_id=NULL)
    {
         if(!is_null($user_id)){
           $connection=Yii::$app->db;
           $command=$connection->createCommand("select role_id from users_roles where user_id='$user_id'");
            $dataReader=$command->queryColumn(); // array of roles
        }
        if(!is_null($role_id)){
        
            $dataReader=array($role_id);
        }
        
       $roles = UsersRoles::find()->where(['user_id' => $user_id])->select(['Role_ID'])->asArray()->all();
       $rolesArray = ArrayHelper::getColumn($roles, 'Role_ID');
       
       $rights = Access::find()->where(['Role_ID' => $rolesArray])->andWhere(['Level_Rights' => [1,2,3,4]])->select(['Module_ID', 'Level_Rights'])->asArray()->all();
    
      $access = [
        'view' => [],
        'create' => [],
        'edit' => [],
      ];
      foreach ($rights as $right) {
        if ($right['Level_Rights'] == 3 || $right['Level_Rights'] == 4) $access['edit'][] = $right['Module_ID'];
        if ($right['Level_Rights'] == 2 || $right['Level_Rights'] == 4) $access['create'][] = $right['Module_ID'];
        if ($right['Level_Rights'] > 0)                                 $access['view'][] = $right['Module_ID'];
      }
     
      
       $modules= Access::availableModules($access['view'], NULL);
       $products= Access::availableProducts($access['view'], NULL);
       $projects= Access::availableProjects($access['view'], NULL);
       foreach ($modules as $key=>$value){
             $key=$value->getAttribute('Module_ID'); 
            $h33[$key]['Name']=$value->getAttribute('Name');
            $h33[$key]['Product_ID']=$value->getAttribute('Product_ID');
       }
       foreach ($products as $key=>$value){
            $key=$value->getAttribute('Product_ID'); 
            $h22[$key]['Name']=$value->getAttribute('Name');
            $h22[$key]['Project_ID']=$value->getAttribute('Project_ID');
         }
        foreach ($projects as $key=>$value){
            $key=$value->getAttribute('Project_ID'); 
            $h11[$key]=$value->getAttribute('Name');
         }
         
         
        $j['projects']=$h11;
        $j['products']=$h22;
        $j['modules']=$h33;
        $j['accesses']=$rights;
       
        return $j;
     }
    
      static function availableModules($avail_list, $product_id = null) {
      $query = Modules::find();
      $condition = ['Product_ID' => $product_id];
      $modules = $query->where(['Module_ID' => $avail_list])->andFilterWhere($condition)->all();
      return $modules;
    }

    static function availableProducts($avail_list, $project_id = null) {
      $query = Products::find();
      $condition = ['Project_ID' => $project_id];

      $modules = Access::availableModules($avail_list);
      $productIdArray = ArrayHelper::getColumn($modules, 'Product_ID');

      $products = $query->where(['Product_ID' => $productIdArray])->andFilterWhere($condition)->all();

      return $products;
    }

    static function availableProjects($avail_list) {
      $query = Projects::find();

      $products = Access::availableProducts($avail_list);
      $projectIdArray = ArrayHelper::getColumn($products, 'Project_ID');

      $projects = $query->where(['Project_ID' => $projectIdArray])->all();
      return $projects;
    }
     
    
      public static function show_tree_access1($user_id=NULL, $role_id=NULL)
    {
         // $user_id=1;
        // $role_id=35;
        if(!is_null($user_id)){
           $connection=Yii::$app->db;
           $command=$connection->createCommand("select role_id from users_roles where user_id='$user_id'");
            $dataReader=$command->queryColumn(); // array of roles
        }
        if(!is_null($role_id)){
        
            $dataReader=array($role_id);
        }
        $h1=  Projects::find()->all();
         foreach ($h1 as $key=>$value){
            $key=$value->getAttribute('Project_ID'); 
            $h11[$key]=$value->getAttribute('Name');
         }
        $h2= Products::find()->all();
         foreach ($h2 as $key=>$value){
            $key=$value->getAttribute('Product_ID'); 
            $h22[$key]['Name']=$value->getAttribute('Name');
            $h22[$key]['Project_ID']=$value->getAttribute('Project_ID');
         }
        $h3= Modules::find()->all();
         foreach ($h3 as $key=>$value){
            $key=$value->getAttribute('Module_ID'); 
            $h33[$key]['Name']=$value->getAttribute('Name');
            $h33[$key]['Product_ID']=$value->getAttribute('Product_ID');
         }
       // $h4= Access::find()->all();
        // $condition='role_id IN ('.implode(',', $dataReader).')';
        //$h4= Access::findByCondition($condition)->all();
          //  var_dump($h4);
       // $h4 = Access::find();
          //$condition = ['Role_id' => $role_id];
          //$products = $query2->where($condition)->all();
           $connection=Yii::$app->db;
           if(!is_null($dataReader)){
           $command=$connection->createCommand("select * from Access where Role_id IN (".implode(',', $dataReader).")");
           }
           else 
           {
               $command=$connection->createCommand("select * from Access");
           }
            $h4=$command->query()->readAll(); // 
;
        foreach ($h4 as $key=>$value){
            $key=$value['id']; 
            $h44[$key]['Role_ID']=$value['Role_id'];
            $h44[$key]['Module_ID']=$value['Module_ID'];
            $h44[$key]['Level_Rights']=$value['Level_Rights'];
         }
        
        $j['projects']=$h11;
        $j['products']=$h22;
        $j['modules']=$h33;
        $j['accesses']=$h44;
       // echo "<pre>";
       // var_dump($j);
        //echo "</pre>";
        return $j;
    }
    
    
    
  

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Role_id', 'Module_ID', 'Level_Rights'], 'required'],
            [['id', 'Role_id', 'Module_ID', 'Level_Rights'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Role_id' => 'Role ID',
            'Module_ID' => 'Module  ID',
            'Level_Rights' => 'Level Rights',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['Module_ID' => 'Module_ID']);
    }
}

<?php
/*
*function to search the word or link in all database tables
*/
function searchAllDB($search){
  //defining wpdb class object
   global $wpdb;
   $i=0;

   $sql = "show tables";
   //getting the list of all the tables in the database
   $rs = $wpdb->get_results($sql);
   if($rs > 0){
       foreach ($rs as $r) {
           $table = $r->Tables_in_wordpress;
           //creating the query for database
           $sql_search = "SELECT * FROM ".$table." WHERE ";
           $sql_search_fields = Array();
           //getting the columns of tables
           $sql2 = "SHOW COLUMNS FROM ".$table;
           $rs2 = $wpdb->get_results($sql2);
           if($rs2 > 0){
               foreach($rs2 as $r2){
                   $column = $r2->Field;
                   //creating the full query for database
                   $sql_search_fields = $column." like('%".$search."%')";
                   $sql_search .= $sql_search_fields;
                   //getting the results from the database
                   $rs3 = $wpdb->get_results($sql_search);
                   //printing the message once
                   if($i==0) {
                     ?><div class="wrap">
                       <h1>Found</h1></br>
                       <h2>Dry run opted. No changes were made to database</h2>
                     </div>
                     <?php $i++;
                   }
                   //printing the details of found data
                   if(count($rs3)> 0){
                   echo nl2br("Found in table <strong>$table</strong> in <strong>$column</strong> attribute\n");
                 }
                 $sql_search = "SELECT * FROM ".$table." WHERE ";

               }
           }
       }
   }
}
?>

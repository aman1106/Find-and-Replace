<?php
function replaceDB($find,$replace)
{
  global $wpdb;
  $i=0;
  $out = "";

  $sql = "show tables";
  $rs = $wpdb->get_results($sql);
  if($rs > 0){
      foreach ($rs as $r) {
          $table = $r->Tables_in_wordpress;
          $out .= $table.";";
          $sql_search = "SELECT * FROM ".$table." WHERE ";
          //var_dump($sql_search);
          $sql_search_fields = Array();
          //var_dump($sql_search_fields);
          $sql2 = "SHOW COLUMNS FROM ".$table;
          //var_dump($sql2);
          $rs2 = $wpdb->get_results($sql2);
          //var_dump($rs2);
          if($rs2 > 0){
              foreach($rs2 as $r2){
                //var_dump($r2);
                  $column = $r2->Field;
                  //var_dump($column);
                  $sql_search_fields = $column." like('%".$find."%')";
                  $sql_search .= $sql_search_fields;
                  //var_dump($sql_search);
                  //var_dump($sql_search_fields);
                  //echo "hi";

                  $rs3 = $wpdb->get_results($sql_search);
                  //var_dump($rs3);
                  if($i==0) {
                    ?><div class="wrap">
                      <h1>Word Found</h1></br>
                      <h2>Word Replaced in Database in Following Tables</h2>
                    </div>
                    <?php $i++;
                  }
                  if(count($rs3)> 0){
                    //echo "hi"."\n";
                    //var_dump($rs3);
                    //echo $column;
                    $wpdb->update($table, array($column => $replace), array($column => $find));
                    echo nl2br("Replaced in table <strong>$table</strong> in <strong>$column</strong> attribute\n");
                }
                $sql_search = "SELECT * FROM ".$table." WHERE ";
              }
          }
      }
  }
}
?>

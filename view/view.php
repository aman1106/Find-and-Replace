<?php
include_once(plugin_dir_path(__FILE__) . '../controller/searchDB.php');
include_once(plugin_dir_path(__FILE__) . '../controller/replaceDB.php');
function find_replace()
{
  ?>
  <div class="wrap">
       <h2>Find and Replace</h2>
       <h2 class="nav-tab-wrapper">
           <a href="?page=findreplace&tab=backup_database" class="nav-tab">Backup Database</a>
           <a href="?page=findreplace&tab=Find_and_Replace" class="nav-tab">Find and Replace</a>
       </h2>
       <?php
       if($_GET['page']=='findreplace' && $_GET['tab']=='backup_database') { ?>
         <form method="POST" action="">
           <?php
           echo "<h2>Take a backup of your database by clicking \"Take Database Backup\"\n\n</h2>";
           ?>
           <input type="submit" name="submit" id="submit" class="button button-primary" value="Take Database Backup"  />
         </form>
       <?php }
       else {?>
        <form method="POST" action="">
          <table class="form-table">
              <tr valign="top">
                  <th scope="row">
                      <label for="num_elements">
                          Find for(Required):
                      </label>
                  </th>
                  <td>
                      <input type="text" name="find-word"  size="20" placeholder="Your Text Here"/>
                      <?php if (isset($_POST["find-word"]))
                      $find = esc_attr($_POST["find-word"]);
                      ?>

                  </td>
              </tr>
              <tr>
                  <th scope="row">
                    <label for="num_elements">
                        Replace with(Required):
                    </label>
                  </th>
                  <td>
                      <input type="text" name="replace-word"  size="20" placeholder="Your Text Here"/>
                      <?php if (isset($_POST["replace-word"]))
                      $replace = esc_attr($_POST["replace-word"]);
                      ?>
                  </td>
            </tr>
          </table>
          <p>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Dry Run"  />
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Replace"  />
          </p>
        </form>
      <?php } ?>
      </div>
      <?php
      if((isset($_POST['submit']) && $_POST['submit']=="Take Database Backup")) {
        require_once(ABSPATH . 'wp-config.php');
        //echo DB_NAME;
        //echo DB_USER;
        backup_tables(DB_HOST , DB_USER , DB_PASSWORD , DB_NAME);
        //echo "<h2>hey there</h2>";
      }
      //var_dump($_POST);
      if((isset($_POST['submit']) && $_POST['submit']=="Dry Run")) {
      if($_POST["find-word"]=='')
      {
        echo  "<h2>Enter the word</h2>";
        //searchAllDB($find);
      }
      else {
        searchAllDB($find);
        //var_dump($output);
      }
     }
     if((isset($_POST['submit']) && $_POST['submit']=="Replace")) {
       if($_POST["find-word"]=='' && $_POST["replace-word"]!='')
       {
         echo "<h2>Enter the \"find\" word</h2>";
       }
       else if($_POST["replace-word"]=='' && $_POST["find-word"]!='')
       {
         echo "<h2>Enter the \"replace\" word</h2>";
       }
       else if($_POST["find-word"]=='' && $_POST["replace-word"]=='')
       {
         echo "<h2>Enter \"find\" and \"replace\" word</h2>";
       }
       else
       {
         replaceDB($find,$replace);
       }
     }
}
?>

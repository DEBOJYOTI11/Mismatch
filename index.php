<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Where opposites attract!';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  // Retrieve the user data from MySQL
  $query = "SELECT user_id, first_name, picture FROM mismatch_user WHERE first_name IS NOT NULL ORDER BY join_date DESC LIMIT 5";
  $data = mysqli_query($dbc, $query);

  // Loop through the array of user data, formatting it as HTML
    ?>
<div class="row">
<div class="col-lg-5">
  <div class="panel panel-default">
                
                <?php
              echo '<h2><div class="panel-heading">Latest members:</div></h2>';
              echo '<div class="panel-body">';
              echo '<div class="list-group" >';

              while ($row = mysqli_fetch_array($data)) {
                if (is_file(MM_UPLOADPATH . $row['picture']) && filesize(MM_UPLOADPATH . $row['picture']) > 0) {
                  echo '<li class="list-group-item" ><img src="' . MM_UPLOADPATH . $row['picture'] . '" alt="' . $row['first_name'] . '" id="imm"/>';
                }
                else {
                  echo '<li class="list-group-item"><img src="' . MM_UPLOADPATH . 'nopic.jpg' . '" alt="' . $row['first_name'] . '" id="imm" /></td>';
                }
                if (isset($_SESSION['user_id'])) {
                  echo '<a href="viewprofile.php?user_id=' . $row['user_id'] . '">' . $row['first_name'].'</a></li>';
                }
                else {
                  echo '' . $row['first_name'] . '</li>';
                }
              }
              echo '</div>';
               echo '</div>'; 
              mysqli_close($dbc);
            ?>
      </div>
  </div>
</div>
</div>

<?php
  // Insert the page footer
  require_once('footer.php');
?>

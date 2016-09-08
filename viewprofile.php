<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'View Profile';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Grab the profile data from the database
  if (!isset($_GET['user_id'])) {
    $query = "SELECT username, first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_SESSION['user_id'] . "'";
  }
  else {
    $query = "SELECT username, first_name, last_name, gender, birthdate, city, state, picture FROM mismatch_user WHERE user_id = '" . $_GET['user_id'] . "'";
  }
  $data = mysqli_query($dbc, $query);

  if (mysqli_num_rows($data) == 1) {
    // The user row was found so display the user data
    $row = mysqli_fetch_array($data);

    echo '<div class="row">';
    echo '<div class="col-lg-6 col-lg-offset-3">';
            echo '<ul class="list-group">';

                    if (!empty($row['username'])) {
                      echo ' <li class="list-group-item active"><b id="label_for_view">Username:&nbsp;&nbsp;&nbsp;</b>       ' . $row['username'] . '</li>';
                    }
                    if (!empty($row['first_name'])) {
                      echo ' <li class="list-group-item"><b id="label_for_view">First name: &nbsp;&nbsp;&nbsp;</b>' . $row['first_name'] . '</li>';
                    }
                    if (!empty($row['last_name'])) {
                      echo ' <li class="list-group-item"><b id="label_for_view">Last name: &nbsp;&nbsp;&nbsp;</b> ' . $row['last_name'] . '</li>';
                    }
                    if (!empty($row['gender'])) {
                      echo ' <li class="list-group-item"><b id="label_for_view">Gender:&nbsp;&nbsp;&nbsp;</b> ';
                      if ($row['gender'] == 'M') {
                        echo 'Male';
                      }
                      else if ($row['gender'] == 'F') {
                        echo 'Female';
                      }
                      else {
                        echo '?';
                      }
                      echo '</li>';
                    }
                    if (!empty($row['birthdate'])) {
                      if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
                        // Show the user their own birthdate
                        echo ' <li class="list-group-item"><b id="label_for_view">Birthdate:&nbsp;&nbsp;&nbsp;</b> ' . $row['birthdate'] . '</li>';
                      }
                      else {
                        // Show only the birth year for everyone else
                        list($year, $month, $day) = explode('-', $row['birthdate']);
                        echo ' <li class="list-group-item"><b id="label_for_view">Year born:&nbsp;&nbsp;&nbsp;</b>' . $year . '</li>';
                      }
                    }
                    if (!empty($row['city']) || !empty($row['state'])) {
                      echo '<li class="list-group-item"><b id="label_for_view">Location:&nbsp;&nbsp;&nbsp;</b>' . $row['city'] . ', ' . $row['state'] . '</li>';
                    }
                    if (!empty($row['picture'])) {
                      echo ' <li class="list-group-item"><b id="label_for_view">Picture:&nbsp;&nbsp;&nbsp;</b><img src="' . MM_UPLOADPATH . $row['picture'] .
                        '" alt="Profile Picture" /></li>';
                    }
                    echo '</table>';
                    if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
                      echo ' <li class="list-group-item">Would you like to  <a href="editprofile.php">edit your profile</a>?</li>';
                    }
                  } // End of check for a single row of user results
                  else {
                    echo ' <li class="list-group-item"><p class="error">There was a problem accessing your profile.</p></li>';
                  }
          echo '</ul>';

          mysqli_close($dbc);
        ?>

<?php
  // Insert the page footer
  require_once('footer.php');
?>

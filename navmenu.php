
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
<div class="navbar-header">
  
<?php
    
  if (isset($_SESSION['username'])) {
    ?>

        <a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-home"></span>  Mismatch &#10084;</a>  
        </div>
        
        <ul class="nav navbar-nav">
        
            <li class="active"><a href="viewprofile.php"><span class="glyphicon glyphicon-search"></span> View Profile</a> </li>
            <li><a href="questionnaire.php"><span class="glyphicon glyphicon-plus"></span> Questionnaire</a> </li>
            <li><a href="mymismatch.php"><span class="glyphicon glyphicon-star"></span> My Mismatch &#10084;</a></li> 
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="editprofile.php"><span class="glyphicon glyphicon-cog"></span>Edit Profile</a></li> 
            <li><a href="logout.php">  <span class="glyphicon glyphicon-log-out"></span>  Log Out (<?php echo $_SESSION['username']; ?> )</a></li>
        </ul>
  <?php

  }
  else {

  ?>
    <a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-home"></span>  Mismatch &#10084;</a>   
    </div>

    <ul class="nav navbar-nav">';
    <li class="active"><a href="login.php" > <span class="glyphicon glyphicon-log-in"></span>  Log In</a><li>
    
    <li><a href="signup.php" class="navbar-brand"> <span class="glyphicon glyphicon-th"></span>   Sign Up </a></li>
    </ul>
  <?php
  }
  ?>

</div>
</nav>
    
<hr>
<?php
  echo '<div id="head" class="page-header"><h2>Mismatch - ' . $page_title . '</h2></div>';
?>

    
    

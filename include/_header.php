<style>
.bg {
    background-image: url("img/nav.jpg");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;

}
.nav-toggle-button {
color: gray;
}
</style>
<?php
session_start();
echo'
<nav class="navbar navbar-expand-lg navbar-light bg">
  <a class="navbar-brand text-dark" href="index.php">Meditab</a>
  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-dark" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown text-dark">
        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

     
        include 'dbconnect.php';
        $sql= "SELECT DISTINCT(disease) FROM `disease` LIMIT 4";
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
          if(isset($_SESSION['login']) && $_SESSION['login']==true){
            echo '<a class="dropdown-item" href="../'. $row['disease'].'/'. $row['disease'].'.php">'. $row['disease'].'</a>';
           }
           else{
             echo '<a class="dropdown-item" href="#" onclick="msg()">'. $row['disease'].'</a>';
           }
        }
        echo ' 
         </div>
        </li>
        <li class="nav-item">
         <a class="nav-link text-dark" href="contact.php">Contact</a>
        </li>
    </ul>
  <div class="row mx-2">';
 
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
    echo '<form class="form-inline my-2 my-lg-0">
      
      <p class="text-light ml-2 my-0">Welcome '.$_SESSION['username'].'</p>
      <a href="include/logout.php" class="btn btn-outline-success ml-2" >Logout</a>
    </form>';
    }
    else
    {
      echo '<form class="form-inline my-2 my-lg-0">
     
      </form>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupModal">Sign up</button>';
    }
   
    echo '</div>
  </div>
</nav>
';
include 'include/loginModal.php';
include 'include/signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Succcess!</strong> You can login now!.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
}

?>
<script>
function msg() {
    alert("Login to view details");
}
</script>
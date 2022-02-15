
<?php
  include_once('php/klas.php');
  $n = new Klas();
        
  if (isset($_POST['submit']))
  {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $n->login($username, $password);   
  } 

  if (isset($_POST['daftar'])) 
  {   
    $nip = $_POST['nip'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $n->daftar($nip, $username, $email,  $password);
  }
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/tamHom.css">
  <link rel="shortcut icon" type="imaage/x-icon" href="gal/logoKotak.png">
  <title>AdWorker|A d' Real Worker</title>
</head> 
<body>
  <a href="visitor/visitor.php">
  <div class = "kotakAtas">
 	  <h1> V I S I T O R S</h1>
	  <h2>Continue as Visitor to Just See Our Great Company With d' Real Worker !</h2>
  </div>
  </a>
  <div class = "kotakTengah"> 
    <h3><b>L O G I N</b></h3>
    <h2>Login as Employe for your complete data | Login as Administrator to change data &nbsp; </h2> 
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">&nbsp;&nbsp; <b>I'm a Employee</button>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">I'm a Adminstrator </b> </button>
  </div>

  <div id="id01" class="modal">
    <form class="modal-content animate" method="POST" action="" >
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
        </span>
        <img src="gal/LogoB.png" alt="Avatar" class="avatar">
      </div>
      <br>
      <div class="containerH">
        <label><b>Username</b></label><br>
          <input type="text" placeholder="Username" name="username" required>
        <br><br>
	      <label><b>Password</b></label><br>
          <input type="password" placeholder="Password" name="password" required>    
        <br>
        <br>
	      <button type="submit"  class="tombol" name="submit" ><h1>Login</h1></button>
	      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="tombolCL"><h1>Cancel</h1></button>
	      <br><br>
	    </div>
    </form>
  </div>

  <div class = "kotakBawah"><br>
	  <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><b>S I G N &nbsp; U P</b></button>
	  <h2>Create new account for new member !</h2> 
  </div>

  <div id="id02" class="modal">
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" method="post" = action="">
      <div class="containerH">
        <h3>Daftar Akun</h3>
        <h4>Isi Data berikut untuk membuat akun baru.</h4>
        <hr>
        <b>NIP</b><br>
          <input type="text" placeholder="Masukkan NIP Anda" name="nip" required>
  	    <b>Username</b><br>
          <input type="text" placeholder="Masukkan Nama Akun Anda" name="username" required>  
        <b>Alamat Email</b>
          <input type="text" placeholder="Masukkan Alamat Email Anda" name="email" required>
        <b>Password</b><br>
  	      <input type="password" placeholder="Masukkan Password" name="password" required>
        Dengan klik tombol "Sign Up" anda menyetujui seluruh <a href="#" style="color:dodgerblue">kebijakan</a> kami. 
        <br><br>
        <div class="clearfix">
          <button type="submit" class="tombol" name="daftar"><h1>Sign Up</h1></button>
  		    <button type="button" onclick="document.getElementById('id02').style.display='none'" class="tombolCL"><h1>Cancel</h1></button>
        </div>
      </div>
    </form>
  </div>

<script>
  // modal
  var modal = document.getElementById('id01');

  //  modal close di luar modal 
  window.onclick = function(event) 
  {
    if (event.target == modal) 
    {
      modal.style.display = "none";
    }
  }
</script>
</body>
</html> 


<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if (isset($_POST['submit']))
  {
      $username = $_POST['username'];
      $password = $_POST['password']; 
      $n->loginVisitor($username, $password);
  } 
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/tam.css">
  <link rel="shortcut icon" type="imaage/x-icon" href="../gal/logoKotak.png">
  <title>AdWorker|A d' Real Worker</title>
</head> 
<body>
  <div class="header">
  </div>
  <div class="topnav" >
    <button onclick="document.getElementById('id01').style.display='block'" 
      style="float:left;">&nbsp;&nbsp; I'm a Employee &nbsp;&nbsp;</button>
    <button onclick="document.getElementById('id01').style.display='block'" 
      style="float:left;">I'm a Adminstrator </h6></button> 
    <div class="dropdown">
      <div class="containerM" onclick="myFunctionX(this)">
        <div onclick="myFunctionMenu()" class="dropbtn">
          <div class="bar1" onclick="myFunctionMenu()"></div>
          <div class="bar2" onclick="myFunctionMenu()"></div>
          <div class="bar3" onclick="myFunctionMenu()"></div>
        </div>
       </div>
    </div>

    <div id="myDropdown" class="dropdown-content">
      <a href="../hom.php" >Home</a><br>
      <a href="?ourCom.php" >Our Company</a><br>
      <a href="?news.php" >New News</a><br>
      <a href="?track.php" >Track Record</a><br>
      <a href="?job.php" >Our Job</a><br>
      <a href="gal.php" >Gallery</a><br>
      <a href="#" >Exit</a>
    </div>
  
  </div>  

    <div id="id01" class="modal">
      <form class="modal-content animate" method="POST" action="">
        <div class="imgcontainer">
          <span onclick="document.getElementById('id01').style.display='none'" 
            class="close" title="Close Modal">&times;</span>
          <img src="../gal/LogoB.png" alt="Avatar" class="avatar">
        </div>
        <hr>
        <div class="containerH">
          <label><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="username" required>
            <br><br>
          <label><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="password" required>    
            <br><br>
        <button type="submit" class="tombol" name="submit" ><h2>Login</h2></button>
        <button type="button" onclick="document.getElementById('id01').style.display='none'" 
          class="tombolCL"><h2>Cancel</h2></button>
        <br><br>
        </div>
      </form>
    </div>
  
  <div class="row">
    <div class ="leftcolumn">
      <div class="container">
        <div class="mySlides " style="background-color:rgba(0, 0, 0, 0.61);">
          <img src="../gal/RW.png" style="width:100%">
        </div>
        <div class="mySlides ">
          <img src="../gal/LB.png" style="width:100%">
        </div>
        <div class="mySlides fade">
          <img src="../gal/LB1.png" style="width:100%">
        </div>
        <div class="mySlides fade">
          <img src="../gal/LB3.png" style="width:100%">
        </div>
        <div class="mySlides fade">
          <img src="../gal/LB2.png" style="width:100%">
        </div>  
      </div>
      <div class="card">
        <a href="#.php"><h2>Our Company</h2></a>
        <h5> AdWorker |</h5>
        <p> Adalah sebuah perusahaan  </p>
      </div>
      <div class="card">
        <a href="#.php"><h2>Track Record</h2></a>
        <h5>AdWorker|</h5>
        <p> Pernah Melakukan :</p>
          <ol>
          <li></li>
          <li></li>
          <li></li>
          </ol>
      </div>
      <div class="card">
        <a href="#.php"><h2> Personil</h2> </a>
        <table border="1" >
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Jabatan</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $n->tampilPeg2();
            ?>
          </tbody>
        </table>    
      </div>
    </div>

    <div class="rightcolumn">
      <div class="card"> 
        <div class ="imgcontainer">
          <img src="../gal/per.png" class="avatar">
          <h5> AdWorker |</h5><br>
          Adalah sebuah perusahaan<br>
          Alamat : <br>
          e-mail : <br>
        </div>
      </div>
      <div class="card">
        <h2> Whats New</h2>
        <div class="fakeimg"><a href="#.php">Update 1</a></div>
        <div class="fakeimg"><a href="#.php">Update 2</div></a>
        <div class="fakeimg"><a href="#.php">Update 3</div></a>
        <div class="fakeimg"><a href="#.php">See All Update</div></a>
      </div>
      <div class="card">
        <h2>Whats We do?</h2>
        <a href="#.php">Job 1</a><br>
        <a href="#.php">Job 1</a><br>
        <a href="#.php">Job 1</a><br>
        <a href="#.php">See All Our Job</a>
      </div>
    </div>
  </div>
  <div class ="row">
    <div class= "card">
      <a href="gal.php"><h2> Gallery</h2></a>
      <div class="gallery"> 
        <div class="containerGal">
          <span onclick="this.parentElement.style.display='none'" class="close">&times;</span>
          <img id="expandedImg" style="height:60%; width:100%; opacity:1;">     
          <div id="imgtext">
          </div>
        </div>  
        <div class="row">
          <div class="column">
            <img class="demo cursor" src="../gal/gb1.png" style="width:100%;height:100%;" onclick="myFunction(this);" alt="Comfort Meeting">
          </div>
          <div class="column">
            <img class="demo cursor" src="../gal/gb2.png" style="width:100%;height:100%;" onclick="myFunction(this);" alt="Waiting Area">
          </div>
          <div class="column">
            <img class="demo cursor" src="../gal/gb3.png" style="width:100%;height:100%;" onclick="myFunction(this);" alt="Control Room">
          </div>
          <div class="column">
            <a href="gal.php" style="color:#10b3ffb3;text-align:center"><h2>++ More</h2>  </a> 
          </div>
        </div>
      </div>
    </div>
  <div class="footer">
    Adam Junio Selva &copy
  </div>

<script>
  //login
  var modal = document.getElementById('id01');
  window.onclick = function(event) 
  {
    if (event.target == modal) 
    {
      modal.style.display = "none";
    }
  }
  //slide show otomatis
  var slideIndex = 0;
  carousel();

  function carousel() 
  {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) 
    {
      x[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > x.length) {slideIndex = 1}
    x[slideIndex-1].style.display = "block";
    setTimeout(carousel, 5000);
  }
  //menu animasi
  function myFunctionX(x) 
  {
    x.classList.toggle("change");  
  }
  //Dropdown
  function myFunctionMenu() 
  {
    document.getElementById("myDropdown").classList.toggle("show");

    window.onclick = function(event) 
    {
      if (!event.target.matches('.dropbtn')) 
      {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) 
        {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) 
          {
          openDropdown.classList.remove('show');
          }
        }
      }
    }
  }
  //Gallery
  function myFunction(imgs) 
  {
    var expandImg = document.getElementById("expandedImg");
    var imgText = document.getElementById("imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
  }
</script>
</body>
</html>
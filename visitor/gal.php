
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
  <link rel="shortcut icon" type="imaage/x-icon" href="../gal/logoKotak.png"/>
  <title>AdWorker|A d' Real Worker</title>
</head> 
<body>
  <div class="header">
  </div>
  <div class="topnav" >
    <button onclick="document.getElementById('id01').style.display='block'" 
     style="float:left;">&nbsp;&nbsp; I'm a Employee &nbsp;&nbsp;
    </button>
    <button onclick="document.getElementById('id01').style.display='block'" 
     style="float:left;">I'm a Adminstrator </h6>
    </button> 
    <div class="dropdown">
      <div class="containerM" onclick="myFunctionX(this)">
        <div onclick="myFunctionMenu()" class="dropbtn">
          <div class="bar1" onclick="myFunctionMenu()"></div>
          <div class="bar2" onclick="myFunctionMenu()"></div>
          <div class="bar3" onclick="myFunctionMenu()"></div>
        </div>
      </div>
	  </div>
	</div>
  
    <div id="myDropdown" class="dropdown-content">
    	<a href="../hom.php" >Home</a><br>
    	<a href="../hom.php" >SignUp</a><br>
    	<a href="../hom.php" >Exit</a>
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
    <div class="card">
      <h2><a>Our Gallery</a></h2>
      <div class="containerGSS">
        <div class="mySlides">
          <div class="numbertext">1 / 4</div>
          <img src="../gal/gb1.png" style="width:100%;height:60%; ">
        </div>

        <div class="mySlides">
          <div class="numbertext">2 / 4</div>
          <img src="../gal/gb2.png" style="width:100%;height:60%; ">
        </div>

        <div class="mySlides">
          <div class="numbertext">3 / 4</div>
          <img src="../gal/gb3.png" style="width:100%;height:60%; ">
        </div>
          
        <div class="mySlides">
          <div class="numbertext">4 / 4</div>
          <img src="../gal/gb4.png" style="width:100%;height:60%; ">
        </div>
          
        <p class="prev" onclick="plusSlides(-1)"><</p>
        <p class="next" onclick="plusSlides(1)">></p>

        <div class="caption-container">
          <p id="caption"></p>
        </div>

        <div class="row">
          <div class="gallery">
            <div class="column">
              <img class="demo cursor" src="../gal/gb1.png" style="width:100%;height:100%;" onclick="currentSlide(1)" 
               alt="Comfort Meeting">
            </div>
            <div class="column">
              <img class="demo cursor" src="../gal/gb2.png" style="width:100%;height:100%;" onclick="currentSlide(2)" 
               alt="Waiting Area">
            </div>
            <div class="column">
              <img class="demo cursor" src="../gal/gb3.png" style="width:100%;height:100%;" onclick="currentSlide(3)" 
               alt="Control Room">
            </div>
            <div class="column">
              <img class="demo cursor" src="../gal/gb4.png" style="width:100%;height:100%;" onclick="currentSlide(4)" 
               alt="Briefing Room">
            </div>
          </div>
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
  //slide show gallery
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) 
  {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) 
  {
  showSlides(slideIndex = n);
  }

  function showSlides(n) 
  {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    
    if (n > slides.length) 
    {
      slideIndex = 1
    }
    
    if (n < 1) 
    { 
      slideIndex = slides.length
    }
    
    for (i = 0; i < slides.length; i++) 
    {
      slides[i].style.display = "none";
    } 
    
    for (i = 0; i < dots.length; i++) 
    {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
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
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  }
</script>

</body>
</html>

<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));
  
    extract($n->dapatGajiAwal($_GET['id']));
  
    extract($n->dapatAkun($_GET['id']));    
  }
  else
  {
    header("location:../hom.php");
  }

  if (isset($_POST['edit'])) 
  {
    $nip = $_POST['nip'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $akun_id =$_POST['akun_id'];

    $ngubah = $n->ubahAkun($username, $email,  $password, $akun_id, $nip );

    if($ngubah)
    {
      $msg = "PERUBAHAN BERHASIL";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    else
    {
      $msg = "TERJADI KESALAHAN, HARAP CEK KEMBALI ISIAN ANDA";
      echo "<script type='text/javascript'>alert('$msg');</script>";
    }
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
    <a class="dashboard" style="float:left">Dashboard</a>
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
      <a href="gawai.php?id=<?=$nip?>" >Dashboard</a><br>
      <a href="../visitor/visitor.php" >Visitors Page</a><br>
      <a href="#.php" >News</a><br>
      <a href="#.php" >Pengumuman</a><br>
      <a href="../visitor/gal.php" >Gallery</a><br>
      <a href="../hom.php">Exit</a>
	  </div>

  </div>
  <div class="row">
    <div class="columnA">
      <div class="cardB">
        <a href="bio.php?id=<?=$nip?>">
          <img src="../gal/tampilData.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Biodata </h5><br>
          <b>Menampilkan Data Anda</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
    <div class="columnB">
      <div class="cardB">
        <a href="gajiGawai.php?id=<?=$nip?>">
          <img src="../gal/gaji.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Gaji</h5><br>
          <b>Melihat Rincian Gaji</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
    <div class="columnC">
      <div class="cardB">
        <a href="jobGawai.php?id=<?=$nip?>">
          <img src="../gal/edit.png" class="avatar" style="width:120px;height:120px;float:left;">
          <h5> Job</h5><br>
          <b>Tentang Pekerjaan Anda</b><br>
          AdWorker <br>
          A d' Real Worker <br>
        </a>
      </div>
    </div>
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
          <img src="../gal/gb4.png" style="width:100%;height:47%">
        </div>
        <div class="mySlides fade">
          <img src="../gal/LB3.png" style="width:100%">
          </div>
        <div class="mySlides fade">
          <img src="../gal/bk.png" style="width:100%;height:47%">
        </div>
      </div>
      <div class="card">
        <a href="bio.php?id=<?=$nip?>"> <h2>Anda </h2></a>
        <form class="forem"  method="" action="" style="padding-left:11%;">
          <div class ="imgcontainer">
    
            <?php
              if($jk == 'L')
              {
                echo "<img src='../gal/avaL.png' class='avatar'>";
              } 
              else
              { 
                echo "<img src='../gal/avaP.png' class='avatar'>";
              } 
            ?>    
          </div>
          <hr>
          <div class="leftforem">
            <label>NIP</label>
              <input type="text" name="nip"  value="<?=$nip?>" readonly="readonly">
            <label>Jenis Kelamin</label><br>
              <p style="background-color:#f1f1f1;font-size:20px;">
                
                <?php
                  if ($jk == 'L' ) 
                  {
                ?>
                
                    <input type="radio" name="jk" value="L" checked disabled="disabled"> L
                    <input type="radio" name="jk" value="P"  style="margin-left:100px" disabled="disabled"> P
                
                <?php
                  }
                  else
                  {
                ?>
                
                    <input type="radio" name="jk" value="L" disabled="disabled"> L
                    <input type="radio" name="jk" value="P"  style="margin-left:100px" checked disabled="disabled"> P
                
                <?php
                  }
                ?>
 
              </p>
            <br>
            <label>Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="date" value="<?=$tgl_lahir?>" readonly="readonly"><br><br>
            <hr style="width:100%;float:left;margin-left:0%;margin-top:12px;"><br>
            <label>username</label>
              <input type="text" name="username" value="<?=$username?>">
            <hr style="width:100%;float:left;margin-left:0%;margin-top:0px;">
            <label>Gaji Total</label>
            <br><br><br><br>  
          </div>
          <div class="rightforem">    
            <label>Nama</label><br>
              <input type="text" name="nama" value="<?=$nama?>"   readonly="readonly">
            <label>Alamat</label>
              <input type="text" name="alamat" value="<?=$alamat?>" readonly="readonly" ><br>
            <label style="float:left;">No. Telp</label><label style="padding-left: 34%;">Jabatan</label><br>
              <input type="text" name="no_t" value="<?=$no_t?>"  style="width:49%;float:left;" readonly="readonly">
              <input type="text" name="jab" value="<?=$jab?>" style="width:49%;float:right;" readonly="readonly">
            <hr style="width:100%;float:left;margin-left:0%;margin-top:15px;">
            <label>e-mail</label>
              <input type="text" name="email" value="<?=$email?>">
            <hr style="width:100%;float:left;margin-left:0%;margin-top:0%;">
            <input type="text" name="gj_ttl" value="<?=$gj_ttl?>" placeholder="Total Gaji" readonly="readonly">
          </div>
          <br>
          <input type="submit" name="edit" value="SIMPAN" class="forembtn" style="width:0%;height:0%;">
          <a href="gajiGawai.php?id=<?=$nip?>" style="text-align:left">RINCIAN GAJI</a>
          <a href="jobGawai.php?id=<?=$nip?>" style="text-align:right">JOB ANDA</a>  
        </form>
      </div>
      <div class="card">
        <a><h2> Data Pegawai</h2> </a>
          <table border="1">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Jabatan</th>
            </tr>
      
            <?php
              $n->tampilPeg2();
            ?>
        
          </table>    
      </div>
    </div>
    <div class="rightcolumn">
	    <div class="card"> 
	      <div class ="imgcontainer">
          <h5>W e l c o m e !</h5>
    
          <?php
            if($jk == 'L')
            {
              echo "<img src='../gal/avaL.png' class='avatar'>";
            } 
            else
            { 
              echo "<img src='../gal/avaP.png' class='avatar'>";
            } 
          ?>
 
          <h5><?=$nama?></h5><br>  	
        	AdWorker |<br>
        	Adalah sebuah perusahaan<br>
        	Alamat : <br>
        	e-mail : <br>
          <br>
          <hr>
          <button onclick="document.getElementById('id01').style.display='block'" class="forembtn" 
           style="height:50px;width:80%;margin-top:-12px;" >
            <p style="font-size:20px;margin:11px -7px -7px 0px;" >Ubah Akun</p>
          </button>
          <br>
          <hr>
        </div>           
      </div>

      <div id="id01" class="modal">
        <form class="modal-content animate" method="POST" action="" style="margin-top:0px;">
          <div class ="imgcontainer">
    
            <?php
              if($jk == 'L')
              {
                echo "<img src='../gal/avaL.png' class='avatar'>";
              } else{ 
                echo "<img src='../gal/avaP.png' class='avatar'>";
              } 
            ?>       

          <span onclick="document.getElementById('id01').style.display='none'" class="close" 
             title="Close Modal">&times;</span>
          </div>
          <hr>
          <div class="containerH">
            <input type="hidden" name="akun_id" value="<?=$akun_id?>" readonly="readonly">
            <input type="hidden" name="nip" value="<?=$nip?>" readonly="readonly">          
            <label><b>e-mail</b></label><br>
              <input type="text"  name="email" value="<?=$email?>" required>
            <label><b>Username</b></label><br>
              <input type="text"  name="username" value="<?=$username?>" required>
            <br><br>
            <label><b>Password</b></label><br>
              <input type="text"  name="password" value="<?=$password?>" required>    
            <br>
            <button type="submit" class="tombol" name="edit" ><h2>Simpan</h2></button>
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="tombolCL">
              <h2>Cancel</h2>
            </button>
            <br>
          </div>
        </form>
      </div>          
      
      <div class="card">
	      <h2> Whats New</h2>
	      <div class="fakeimg"><a href="#.php">Update 1</a></div>
        <div class="fakeimg"><a href="#.php">Update 2</div></a>
        <div class="fakeimg"><a href="#.php">Update 3</div></a>
    	  <div class="fakeimg"><a href="#.php">See All Update</div></a>
      </div>
      <div class="card">
      	<h2 style="font-size:35px">Pengumuman</h2>
      	<a href="#.php">Pengumuman 1</a><br>
      	<a href="#.php">Pengumuman 2</a><br>
        <a href="#.php">Pengumuman 3</a><br>
      	<a href="#.php">See All </a>
      </div>
      <div class="card">
        <h2> Data Perusahaan</h2>
        <div class="fakeimg"><a href="#.php">Sejarah</a></div>
        <div class="fakeimg"><a href="#.php">Track Record</div></a>
        <div class="fakeimg"><a href="#.php">Penghargaan</div></a>
        <div class="fakeimg"><a href="#.php">See All </div></a>
      </div>
    </div>
  </div>
  <div class ="row">
  <div class ="row">
    <div class= "card">
      <a href="../visitor/gal.php"><h2> Gallery</h2></a>
      <div class="gallery">   
        <div class="containerGal">
          <span onclick="this.parentElement.style.display='none'" class="close">&times;</span>
          <img id="expandedImg" style="height:60%; width:100%; opacity:1;">
          <div id="imgtext"></div>
        </div>
      <div class="row">
        <div class="gallery">
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
            <a href="../visitor/gal.php" style="color:#10b3ffb3;text-align:center"><h2>++ More</h2></a> 
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    Adam Junio Selva &copy
  </div>

<script>
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
    
    if (slideIndex > x.length) 
    {
      slideIndex = 1
    }
    
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
  }
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
  //modal edit
  var modal = document.getElementById('id01');
  window.onclick = function(event) 
  {
    
    if (event.target == modal) 
    {
      modal.style.display = "none";
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
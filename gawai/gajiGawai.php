<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));
    extract($n->dapatGajiAwal($_GET['id']));
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
    <a class="dashboard" style="float:left">Gaji Anda</a>
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
    <div class="card">
      <a><h2>Gaji Anda </h2></a>
      <form class="forem"  method="" action="" >
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
          <hr style="width:100%;float:left;margin-left:0%">
          <label>Berkeluarga</label>
          <br><br><br>
          <label>Gaji Pokok</label>
          <br><br><br><br>
          <label>Lembur</label>
          <br><br><br>
          <label>Bonus</label>
          <br><br>
          <hr style="width:100%;float:left;margin-left:0%;margin-top:15px;"><br><br><br>
          <label>Gaji Total</label><br>
        </div>
        <div class="rightforem">    
          <label>Nama</label><br>
            <input type="text" name="nama" value="<?=$nama?>"   readonly="readonly">
          <hr style="width:100%;float:left;margin-left:0%">
          <p style="background-color:#f1f1f1;font-size:20px;">
        
            <?php
              if ($kel == 100000 ) 
              {
            ?>
              
                <input type="radio" name="kel" value="100000" checked disabled="disabled"> S
                <input type="radio" name="kel" value="0"  style="margin-left:100px"  disabled="disabled"> B
            
            <?php
              }
              else
              {
            ?>
        
                <input type="radio" name="kel" value="100000"  disabled="disabled"> S
                <input type="radio" name="kel" value="0"  style="margin-left:100px" checked disabled="disabled"> B
        
            <?php
              }
            ?>

          </p>
          <input type="text" name="gj_p" value="<?=$gj_p?>"  readonly="readonly">
          <input type="text" name="lembur" value="<?=$lembur?>"  readonly="readonly">
          <input type="text" name="bonus" value="<?=$bonus?>"  readonly="readonly" style="width:62%">
          <label style="width:10%">Cuti</label>
            <input type="text" name="cuti" value=" - <?=$cuti?> x 50000" readonly="readonly"
             style="width:26%;float:right;text-align:center;">
          <hr style="width:100%;float:left;margin-left:0%;margin-top:0%;">
          <input type="text" name="gj_ttl" value="<?=$gj_ttl?>" readonly="readonly">
        </div>
        <input type="submit" name="edit" value="SIMPAN" class="forembtn" style="width:0%;height:0%;">
        <br><br>
        <a href="bio.php?id=<?=$nip?>" style="text-align:left">BIODATA</a>
        <a href="jobGawai.php?id=<?=$nip?>" style="text-align:right">JOB ANDA</a>   
        <a href="gawai.php?id=<?=$nip?>">DASHBOARD</a>
      </form>
      <hr>
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
  <div class="footer">
    Adam Junio Selva &copy
  </div>

<script>
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
</script>

</body>
</html>  
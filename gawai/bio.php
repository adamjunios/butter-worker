
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));
  }

  if(isset($_POST['cariJobA']))
  {
    $nama_job = $_POST['nama_job'];
        
    $n->cariJobG($nama_job);   
  }
  if(isset($_POST['cariJobB']))
  {
    $idJob = $_POST['idJob'];
    
    $n->cariJobGB($idJob);   
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
    <a class="dashboard" style="float:left">Biodata</a>
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
    <div class="leftcolumn">
      <div class="card">
        <a><h2>Biodata Anda </h2></a>
        <div class="hr2" style="float:left"></div> 
        <form class="forem"  method="" action="" style="width:auto;padding-left:20px;">
          <div class="leftforem" style="width:20%;">
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
              <input type="date" name="tgl_lahir" class="date" value="<?=$tgl_lahir?>" readonly="readonly"><br>
          </div>
          <div class="rightforem" style="float:left;width:40%;">    
            <label>Nama</label><br>
              <input type="text" name="nama" value="<?=$nama?>"   readonly="readonly">
            <label>Alamat</label>
              <input type="text" name="alamat" value="<?=$alamat?>" readonly="readonly" ><br>
            <label style="float:left;">No. Telp</label><label style="padding-left: 34%;">Jabatan</label><br>
              <input type="text" name="no_t" value="<?=$no_t?>"  style="width:49%;float:left;" readonly="readonly">
              <input type="text" name="jab" value="<?=$jab?>" style="width:49%;float:right;" readonly="readonly">
          </div>
          <div class="hr2" style="float:left"></div>       
          <div class="foremkanan">
            <div class ="imgcontainer" style="margin-top:0px;">
            
              <?php
                if($jk == 'L')
                {
                  echo "<img src='../gal/avaL.png' class='avatar'>";
                } else{ 
                  echo "<img src='../gal/avaP.png' class='avatar'>";
                } 
              ?>    
            
            </div>         
            <a href="gajiGawai.php?id=<?=$nip?>" style="text-align:left">GAJI</a>
            <a href="jobGawai.php?id=<?=$nip?>" style="text-align:right">JOB ANDA</a>   
            <a href="gawai.php?id=<?=$nip?>">DASHBOARD</a>
          </div>
          <input type="submit" name="edit" value="SIMPAN" class="forembtn" style="width:0%;height:0%;">      
        </form>
      </div>
    </div>
    <div class="rightcolumn">
      <div class="card"> 
        <a><h2 style="font-size:36px;">Mesin Pencari</h2></a>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>Judul job</label>
            <input type="text" name="nama_job" placeholder="Cari Judul Job" required>
          <input type="submit" name="cariJobA" value="CARI" class="forembtn" style="width:100%;height:50px">
        </form>
        <hr>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>ID JOB</label>
            <input type="text" name="id_job" placeholder="Cari ID JOB" required>
          <input type="submit" name="cariJobB" value="CARI" class="forembtn" style="width:100%;height:50px">
        </form>
        <hr>
      </div>  
    </div>
  </div>        
  <div class="row">
    <div class="card">
      <a><h2>Track Record</h2></a>
      <div class="row" style="margin-left:-20px;">
        <div class="gallery">

          <?php

            $no = 1;
            $query = "SELECT id_job,nip,nama_job,deadline FROM job WHERE ket='selesai' AND  nip='$nip' ORDER BY id_job DESC";            
            $stmt = $n->kon->query($query);
          
            while ($data = $stmt->fetch_array())
            {
              echo
              "
              <div class=\"column\" id=$no style=\"width:220px;height:200px;\">
                <table border=\"0\" class=\"tableLap\">
                  <tr>
                    <th colspan=\"2\">$data[nama_job]</th>
                  </tr>
                  <tr>
                    <td style=\"width:30%\">Id Job</td>
                    <td style=\"width:70%\" >$data[id_job]</td>
                  </tr>
                  <tr>
                    <td style=\"width:30%\">NIP</td>
                    <td style=\"width:70%\" >$data[nip]</td>
                  </tr>
                  <tr>
                    <th colspan=\"2\">$data[deadline]</th>
                  </tr>  
                  <tr>      
                    <td colspan=\"2\">
                      <a href=\"tampilJob.php?id=$data[nip]&job=$data[id_job]\">++ See</a>
                    </td>
                  </tr>
                </table>                   
              </div>
              ";
              $no++;
            }
          ?>  
                
        </div>
      </div>    
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

<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if(isset($_POST['cari']))
  {
    $name = $_POST['name'];
    
    $n->cariGaj($name);   
  }

  if(isset($_POST['cariJobA']))
  {
    $nama_job = $_POST['nama_job'];
    
    $n->cariJob($nama_job);   
  }

  if(isset($_POST['cariB']))
  {
    $nip = $_POST['nip'];
    
    $n->cariGajB($nip);   
  }

  if(isset($_POST['cariJobB']))
  {
    $idJob = $_POST['idJob'];
    
    $n->cariJobB($idJob);   
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
    <a class="dashboard" style="float:left">Job & Gaji</a>
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
      <a href="admin.php" >Dashboard</a><br>
      <a href="../visitor/visitor.php" >Visitors Page</a><br>
      <a href="?news.php" >News</a><br>
      <a href="?ann.php" >Pengumuman</a><br>
      <a href="../visitor/gal.php" >Gallery</a><br>
      <a href="../hom.php">Exit</a>
    </div>
  
  </div>
  <div class="row">
    <div class ="leftcolumn">
      <div class="card" >
        <a><h2>Job & Gaji</h2></a>
        <h5>Pilih Data</h5>
        <table border="1" style="margin-left:-12px;margin-right:-12px;">
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Gaji Pokok</th>
            <th>Tun. Kel</th> 
            <th>Lembur</th> 
            <th>Bonus</th>  
            <th>Cuti</th> 
            <th>Gaji Total</th>
            <th>Status</th>
            <th colspan="2">Aksi</th>
          </tr>   
        
          <?php
            $no = 1;
            $query = "SELECT * FROM pegawai a, gaji b WHERE a.nip = b.nip";
            $stmt = $n->kon->query($query);
            
            while ($data = $stmt->fetch_assoc()) 
            {
              echo
              "
              <tr>
                <td style='text-align:center'>$no </td>
                <td>$data[nip]</td>
                <td>$data[nama]</td>
                <td>$data[jab]</td>
                <td>$data[gj_p]</td>
                <td>$data[kel]</td>
                <td>$data[lembur]</td>
                <td>$data[bonus]</td>
                <td>- $data[cuti]</td>
                <td>$data[gj_ttl]</td>
                <td>avaible</td>
                <td>
                  <a href='nggaji.php?id=$data[nip]' style='display=none;'><img src='../gal/lgg.png'></a>
                </td>
                <td>
                  <a href='job.php?id=$data[nip]' style='display=none;'><img src='../gal/lgj.png'></a>
                </td>                
              </tr>
              ";
              $no++;
             }
          ?>

        </table>
      </div>    
    </div>
    <div class="rightcolumn">
      <div class="card" style="height:90%">
        <a><h2 style="font-size:36px;">Mesin Pencari</h2></a>
        <form method="post" action="" class="leftforem" style="float:left;width:48%;">
          <label>NAMA</label>
            <input type="text" name="name" placeholder="Cari Nama" required>
          <input type="submit" name="cari" value="CARI" class="forembtn" style="width:100%;height:50px">
          <hr>
        </form>
        <form method="post" action="" class="rightforem" style="float:right;width:48%;">
          <label>Judul Job</label>
            <input type="text" name="nama_job" placeholder="Cari Job" required>
          <input type="submit" name="cariJobA" value="CARI" class="forembtn" style="width:100%;height:50px">
          <hr>
        </form>       
        <form method="POST" action="" class="leftforem" style="float:left;width:48%;">
          <label>NIP</label>
            <input type="text" name="nip" placeholder="Cari NIP" required>
          <input type="submit" name="cariB" value="CARI" class="forembtn" style="width:100%;height:50px">
          <hr>
        </form>
        <form method="post" action="" class="rightforem" style="float:right;width:48%;">
          <label>ID Job</label>
            <input type="text" name="idJob" placeholder="Cari Id Job" required>
          <input type="submit" name="cariJobB" value="CARI" class="forembtn" style="width:100%;height:50px">
          <hr>
        </form>        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="card">
      <a><h2>Update Laporan</h2></a>
      <div class="row">
        <div class="gallery" style="margin-left:-20px;margin-right:-20px;">

          <?php

            $no = 1;
            $query = "SELECT id_job,nip,nama_job,deadline FROM job WHERE ket='selesai' ORDER BY id_job DESC LIMIT 4 ";            
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
                      <a href=\"lap.php?id=$data[nip]&job=$data[id_job]\">++ See</a>
                    </td>
                  </tr>
                </table>                   
              </div>
              ";
              $no++;
            }

              echo 
              "
              <div class=\"column\" id=$no style=\"width:179px;height:200px;\">
                <a href=\"tampil.php\" style=\"color:#10b3ffb3;text-align:center;margin-top:68px;\">
                <h2>++ More</h2>
                </a>   
              </div>
              ";            
          ?>  
                
        </div>
      </div>  
    </div>
  </div>      
  <div class="row">
    <div class="column1">
      <div class="cardB">
        <a href="tambah.php">
          <div class ="imgcontainer">
            <img src="../gal/tambahData.png" class="avatar">
            <h5> Tambah Data</h5><br>
            <b>Menambah Data Pegawai</b><br>
            AdWorker <br>
            A d' Real Worker <br>
          </div>
        </a>  
      </div>
    </div>
    <div class="column2">
      <div class="cardB">
        <a href="tampil.php">
          <div class ="imgcontainer">
            <img src="../gal/tampilData.png" class="avatar">
            <h5> Tampil Data</h5><br>
            <b>Melihat Data Perusahaan</b><br>
            AdWorker <br>
            A d' Real Worker <br>
          </div>
        </a>
      </div>
    </div>
    <div class="column3">
      <div class="cardB">
        <a href="edit.php">
          <div class ="imgcontainer">
            <img src="../gal/edit.png" class="avatar">
            <h5> Edit & Hapus</h5><br>
            <b>Edit / Hapus Data Pegawai</b><br>
            AdWorker <br>
            A d' Real Worker <br>
          </div>
        </a>
      </div>
    </div>
    <div class="column4">
      <div class="cardB">
        <a href="gaji.php">
          <div class ="imgcontainer">
            <img src="../gal/gaji.png" class="avatar">
            <h5> Job & Gaji</h5><br>
            <b>Atur Job & Gaji Pegawai</b><br>
            AdWorker <br>
            A d' Real Worker <br>
          </div>
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
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  //Mendapatkan id
  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));

    extract($n->dapatGajiAwal($_GET['id']));  
  }
  else
  {
    $id = 1001;
    
    extract($n->dapatId($id));

    extract($n->dapatGajiAwal($id));
  }

  if(isset($_GET['job']))
  {
    extract($n->dapatLap($_GET['job']));  

    extract($n->dapatJob($_GET['job']));     
  }

  if(isset($_POST['cari']))
  {
    $name = $_POST['name'];
    
    $n->cariGaj($name);   
  }
  
  if(isset($_POST['cariB']))
  {
    $nip = $_POST['nip'];
    $n->cariGajB($nip);   
  }

  if(isset($_POST['cariJobA']))
  {
    $nama_job = $_POST['nama_job'];
    
    $n->cariJob($nama_job);   
  }
  if(isset($_POST['cariJobB']))
  {
    $idJob = $_POST['idJob'];
    
    $n->cariJobB($idJob);   
  }    

  if(isset($_POST['downloadLap']))
  {
    $id_job = $_POST['id_job'];

    $n->downloadLap($id_job);

    $n->updateLap($id_job);
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

        <div id="id01" class="modal" style="display:block;">
          <form class="modal-content animate foremModal" method="POST" action="" style="font-size:16px;">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">
               &times;</span>
              <h2>Detail Laporan</h2>          
            </div>
            <hr>
            <div class="leftforem" >
              <label><b>ID Job</b></label>
                <input type="text" name="id_job"  value="<?=$id_job?>" readonly="readonly">
                <br>
              <label><b>Judul Job</b></label>
                <input type="text" name="nama_job" value="<?=$nama_job?>" readonly="readonly">
                <br>
              <label><b>Laporan</b></label>  
                <input type="submit" name="downloadLap" class="forembtn" value="Download" 
                 style="height:51px;font-size:18px;width:100%">
            </div>
            <div class="rightforem" >    
              <label><b>NIP</label><label style="padding-left:210px">Nama</b></label><br>
                <input type="text" name="nama" value="<?=$nip?>" style="width:49%" disabled="disabled">
                <input type="text" name="nama" value="<?=$nama?>" style="width:49%" disabled="disabled">
                <br>
              <label><b>DEADLINE</label> <label style="padding-left:152px">Tanggal Setor</b></label><br>
                <input type="date" name="tgl_diberikan" class="date" style="width:49%" 
                 value="<?=$deadline?>" readonly="readonly">
                <input type="date" name="Tgl_setor" value="<?=$tgl_setor?>" class="date" style="width:49%;float:right" readonly="readonly">
                <br><br>
              <label><b>KETERANGAN</b></label>
                <input type="text" value="<?=$ket?>" name="ket">
            </div>
            <input type="reset" name="downloadJob" class="forembtn" value="Download" style="width:0px;height:0px">
            <a style="text-align:left" href="job.php?id=<?=$nip?>">KIRIM PEKERJAAN</a>
            <a style="text-align:right" href="nggaji.php?id=<?=$nip?>">ATUR GAJI</a>
            <a href="gaji.php">CANCEL</a>                
          </form>
          <hr>
        </div>

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
      <div class="row" style="margin-left:-20px;margin-right:-20px;">
        <div class="gallery">

          <?php

            $no = 1;
            $query = "SELECT id_job,nip,nama_job,deadline FROM job WHERE ket='selesai' ORDER BY id_job DESC LIMIT 4";            
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
              <div class=\"column\" id=$no style=\"width:225px;height:200px;\">
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
  //modal edit
  var modal = document.getElementById('id01');
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
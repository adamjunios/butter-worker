<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  //Mendapatkan id
  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));

    extract($n->dapatGajiAwal($_GET['id']));  

    extract($n->lastJob());
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

  if(isset($_POST['upload']) && $_FILES['userfile']['size']-->0)
  {
    $fileName = $_FILES['userfile']['name'];
    $tmpName = $_FILES['userfile']['tmp_name'];
    $fileSize = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];

    $fp = fopen($tmpName,'r');
    $content = fread($fp,fileSize($tmpName));
    $content = addslashes($content);
    fclose($fp);

    if(!get_magic_quotes_gpc())
    {
      $fileName = addslashes($fileName);
    }

    $nip = $_POST['nip'];
    $nama_job = $_POST['nama_job'];
    $tgl_diberikan = $_POST['tgl_diberikan'];
    $deadline = $_POST['deadline'];
    $ket = $_POST['ket'];

    $ngejob = $n->tambahJob($nip, $nama_job, $content, $tgl_diberikan, $deadline, $ket, $fileName, $fileType, $fileSize);

    if($ngejob)
    {
      $msg = "PEKERJAAN TERKIRIM";
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
          <form class="modal-content animate foremModal" enctype="multipart/form-data"  method="POST" action="" 
           style="font-size:16px;">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">
               &times;</span>
              <h2>Kirim Pekerjaan</h2>          
            </div>
            <hr>
            <div class="leftforem" >
              <label><b>ID Job</b></label>
                <input type="text" name="id_job"  value="<?=$id_job+1?>" readonly="readonly">
                <br>
              <label><b>Judul Job</b></label>
                <input type="text" name="nama_job" required="" placeholder="Judul Job" >
                <br>
              <label><b>Detail Job (only <u>.doc</u>)</b></label>  
                <input name="MAX_FILE_SIZE" type="hidden" value="2000000&quot;">
                <input id="userfile" name="userfile" type="file" class="browse" required="">
            </div>
            <div class="rightforem" >    
              <label><b>NIP</label><label style="padding-left:210px">Nama</b></label><br>
                <input type="text" name="nip" value="<?=$nip?>" style="width:49%" readonly="readonly">
                <input type="text" name="nama" value="<?=$nama?>" style="width:49%" disabled="disabled">
                <br>
              <label><b>Tanggal Diberikan</label> <label style="padding-left:95px">DEADLINE</b></label><br>
                <input type="text" name="tgl_diberikan" value="<?php echo date('y/m/d'); ?>" class="date" style="width:49%" readonly="">
                <input type="date" name="deadline" class="date" style="width:49%;float:right" required="">
              <label><b>KETERANGAN</b></label>
                <input type="text" name="ket" placeholder="KETERANGAN">
            </div>               
            <input type="submit" name="upload" id="upload" value="SEND" class="forembtn">
            <input type="reset" name="simpan" value="RESET" class="forembtnRE" >    
            <a href="nggaji.php?id=<?=$nip?>">ATUR GAJI</a>            
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
      <div class="row" style="margin-left:-20px;">
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


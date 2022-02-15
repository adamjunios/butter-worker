
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  if(isset($_POST['downloadJob']))
  {
    $id_job = $_POST['id_job'];

    $n->downloadJob($id_job);
  }

  if(isset($_POST['downloadLap']))
  {
    $id_job = $_POST['id_job'];

    $n->downloadLap($id_job);
  }

  if(isset($_POST['cariJobA']))
  {
    $nama_job = $_POST['nama_job'];
        
    $n->cariJobH($nama_job);   
  }
  if(isset($_POST['cariJobB']))
  {
    $idJob = $_POST['idJob'];
    
    $n->cariJobGHB($idJob);   
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
    <a class="dashboard" style="float:left">Tampil Data</a>
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
    <div class="leftcolumn" style="width:58%;">
      <div class="card">
        <a><h2> Data Pegawai</h2> </a>
        <table border="1">
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Jabatan</th>
          </tr>

          <?php
            $n->tampilPeg();
          ?>

        </table>    
      </div>
    </div>
    <div class="rightcolumn" style="width:40%;">
      <div class="card">
        <a><h2> Data Akun </h2> </a>
        <table border="1">
          <tr>
            <th>No</th>
            <th>id</th>
            <th>NIP</th>
            <th>Username</th>
            <th>Email</th>
          </tr>
        
          <?php
            $n->tampilAkun();
          ?>
        
        </table>    
      </div>
    </div>
  </div>
  <div class="row">
    <div class="leftcolumn">
      <div class="card">
          <a><h2>Job & Gaji</h2></a>
          <h5>Pilih Data</h5>
          <table border="1" >
            <tr>
              <th>No</th>
              <th>Id Job</th>
              <th>Judul Job</th>
              <th>NIP</th>
              <th>Pegawai</th>
              <th>Tanggal Mulai</th>
              <th>Detail</th> 
              <th>Deadline</th> 
              <th>Status</th> 
              <th>Tanggal Setor</th>  
              <th>Laporan</th>
              <th>Aksi</th>
            </tr>   
          
            <?php
              $no = 1;
              $query = "SELECT * FROM job a, lap b WHERE a.id_job = b.id_job";
              $stmt = $n->kon->query($query);
              
              while ($data = $stmt->fetch_assoc()) 
              {

                $query2 = "SELECT * FROM pegawai WHERE nip='$data[nip]'";
                $stmt2 = $n->kon->query($query2);
                $data2 = $stmt2->fetch_assoc();
                echo
                "
                <tr>
                  <form method=\"post\" action=\"\">
                  <td style='text-align:center'>$no </td>
                  <input type=\"hidden\" name=\"id_job\" value=\"$data[id_job]\">
                  <td>$data[id_job]</td>
                  <td>$data[nama_job]</td>
                  <td>$data[nip]</td>
                  <td>$data2[nama]</td>
                  <td>$data[tgl_diberikan]</td>
                  <td>
                    <input type=\"submit\" name=\"downloadJob\" class=\"forembtn\" value=\"Detail\" 
                      style=\"height:52px;font-size:16px;width:auto;margin:-5px\">
                  </td>
                  <td>$data[deadline]</td>
                  <td>$data[ket]</td>
                  <td>$data[tgl_setor]</td>
                  <td>
                    <input type=\"submit\" name=\"downloadLap\" class=\"forembtn\" value=\"Laporan\" 
                      style=\"height:52px;font-size:16px;width:auto;margin:-5px\">
                  </td>
                  <td>
                    <a href='tampilHapus.php?id=$data[nip]&job=$data[id_job]' style='display=none;'>
                      <img src='../gal/lgh.png'>
                    </a>
                  </td>                                 
                </tr>
                </form>
                ";
                $no++;
               }
            ?>

        </table>
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
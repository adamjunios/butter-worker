
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  //Mendapatkan id
  if (isset($_GET['id'])) 
  {
    extract($n->dapatId($_GET['id']));
  }
  else
  {
    $id = 1001;
    
    extract($n->dapatId($id));
  }

  //Mengubah data siswa
  if (isset($_POST['edit'])) 
  {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $no_t = $_POST['no_t'];
    $jab = $_POST['jab'];

    $ngedit = $n->editPeg($nama, $jk, $tgl_lahir, $alamat, $no_t, $jab, $nip);

    if($ngedit)
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

  if(isset($_POST['cari']))
  {
    $name = $_POST['name'];

    $n->cariPeg($name);   
  }
  if(isset($_POST['cariB']))
  {
    $nip = $_POST['nip'];

    $n->cariPegB($nip);   
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
    <a class="dashboard" style="float:left">Edit / Hapus Data</a>
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
      <div class="card">
        <a><h2>Edit & Hapus Data</h2></a>
        <h5>Pilih Data</h5>
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
            <th colspan="2">Aksi</th>
          </tr>

          <?php
            $no = 1;
            $query = "SELECT * FROM pegawai";
            $stmt = $n->kon->query($query);
          
            while ($data = $stmt->fetch_assoc())
            {
              echo
              "
              <tr>
              <td style='text-align:center'>$no </td>
              <td>$data[nip]</td>
              <td>$data[nama]</td>
              <td style='text-align:center'>$data[jk]</td>
              <td>$data[tgl_lahir]</td>
              <td>$data[alamat]</td>
              <td>$data[no_t]</td>
              <td>$data[jab]</td>
              <td>
                <a href='ngedit.php?id=$data[nip]' style='display=none;'><img src='../gal/lge.png'></a>
              </td>
              <td>
                <a href='hapus.php?id=$data[nip]' style='display=none;'><img src='../gal/lgh.png'></a>
              </td>
              </tr>
              ";
              $no++;
            }
          ?>
   
        </table>    

        <div id="id01" class="modal" style="display:block;">
         <form class="modal-content animate foremModal"  method="POST" action="" style="margin-top:-20px;">
            <div class="imgcontainer" >
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              <h2>Edit Data</h2>          
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

                      <input type="radio" name="jk" value="L" checked> L
                      <input type="radio" name="jk" value="P"  style="margin-left:100px"> P
                
                  <?php
                    }
                    else
                    {
                  ?>
                  
                      <input type="radio" name="jk" value="L" > L
                      <input type="radio" name="jk" value="P"  style="margin-left:100px" checked> P
                
                  <?php
                    }
                  ?>

                </p>
              <br>
              <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="date" value="<?=$tgl_lahir?>" ><br>
            </div>
            <div class="rightforem">    
              <label>Nama</label><br>
                <input type="text" name="nama" value="<?=$nama?>"   >
              <label>Alamat</label>
                <input type="text" name="alamat" value="<?=$alamat?>" reuqired><br>
              <label style="float:left;">No. Telp</label><label style="padding-left: 38%;">Jabatan</label><br>
                <input type="text" name="no_t" value="<?=$no_t?>"  style="width:49%;float:left;">
                <input type="text" name="jab" value="<?=$jab?>" style="width:49%;float:right;">
            </div>
            <hr>   
            <input type="submit" name="edit" value="SIMPAN" class="forembtn">
            <input type="reset" name="simpan" value="RESET" class="forembtnRE" >
            <a href="hapus.php?id=<?=$nip?>">HAPUS DATA</a>
            <a href="edit.php">CANCEL</a>
          </form>
          <hr>
        </div>

      </div>
    </div>
    <div class="rightcolumn">
      <div class="card">
        <a><h2 style="font-size:36px;">Mesin Pencari</h2></a>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>NAMA</label>
            <input type="text" name="nama" placeholder="Cari Nama" required>
          <input type="submit" name="cari" value="CARI" class="forembtn" style="width:100%;height:50px">
        </form>
        <hr>
        <form method="post" action="" class="forem" style="padding-left:2px;width:auto;">
          <label>NIP</label>
            <input type="text" name="nip" placeholder="Cari NIP" required>
          <input type="submit" name="cariB" value="CARI" class="forembtn" style="width:100%;height:50px">
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
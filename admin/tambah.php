
<?php
  session_start();
  include_once('../php/klas.php');
  $n = new Klas();

  extract($n->lastNip());

  if (isset($_POST['simpan'])) 
  {
    $jab = $_POST['jab'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $no_t = $_POST['no_t'];
    $kel = $_POST['kel'];

    if($jab == 'MANAGER')
    {
      $gj_p = 3000000;
    }
    else if($jab == 'ANALIS')
    {
      $gj_p = 2200000;
    }
    else 
    {
      $gj_p = 2000000;
    }

    $isiPeg = $n->tambahPeg($nip, $nama, $jk,  $tgl_lahir, $alamat, $no_t, $jab);

    $isiGaji = $n->isiGajiAwal($nip, $gj_p, $kel);

    if($isiPeg && $isiGaji)
    {
      $msg = "PENGISIAN DATA BERHASIL";
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
    <a class="dashboard" style="float:left">Tambah Data</a>
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
    <div class="card">
      <a><h2>Tambah Data Pegawai </h2></a><hr>
      <form method="post" action="" class="forem">
        <div class="leftforem">
          <label>NIP</label>
            <input type="text" name="nip" value="<?=$nip+1?>"  readonly ="readonly" >
          <label>JK</label><label style="margin-left:30%;">Berkeluarga</label><br>
            <p style="background-color:#f1f1f1;">
              <input type="radio" name="jk" value="L" required> L
              <input type="radio" name="kel" value="100000" required style="margin-left:25%;"> Sudah<br>
              <input type="radio" name="jk" value="P" required style="margin-left:2%"> P
              <input type="radio" name="kel" value="0" required style="margin-left:24%"> Belum</p>
          <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="date" required><br>
        </div>
        <div class="rightforem">    
          <label>Nama</label><br>
            <input type="text" name="nama" placeholder="Masukkan Nama"  required >
          <label>Alamat</label>
            <input type="text" name="alamat" placeholder="Massukkan Alamat" reuqired><br>
          <label style="float:left;">No. Telp</label><label style="padding-left: 34%;">Jabatan</label><br>
            <input type="text" name="no_t" placeholder="Masukkan No. Telp" required style="width:49%;float:left;">
          <select name="jab"  required style="width:49%;float:right; height:51px;margin-top:4px;">
            <option  style="display:none">Jabatan</option>
            <option value="MANAGER">MANAGER</option>
            <option value="ANALIS">ANALIS</option>
            <option value="PEGAWAI">PEGAWAI</option>
          </select>
        </div>
        <hr>   
        <input type="submit" name="simpan" value="SIMPAN" class="forembtn">
        <input type="reset" name="simpan" value="RESET" class="forembtnRE" >
        <a href="admin.php">KEMBALI</a>
      </form>  
      <hr>
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
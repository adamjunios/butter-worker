
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

  if (isset($_POST['editAdmin'])) 
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ngubah = $n->ubahAdmin($username, $password );

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
      <a href="admin.php" >Dashboard</a><br>
      <a href="../visitor/visitor.php" >Visitors Page</a><br>
      <a href="?news.php" >News</a><br>
      <a href="?ann.php" >Pengumuman</a><br>
      <a href="../visitor/gal.php" >Gallery</a><br>
  	  <a href="../hom.php">Exit</a>
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
  <div class="row">
    <div class ="leftcolumn">
      <div class="card">
        <a href="tambah.php"> <h2>Tambah Data Pegawai </h2></a>
        <hr style="margin-left:8%;width:700px;">
        <form method="post" action="" class="forem" style="padding-left:4%;width:800px">
          <div class="leftforem">
            <label>NIP</label>
              <input type="text" name="nip" value="<?=$nip+1?>"  readonly ="readonly" >
            <label>J K</label><label style="margin-left:30%;">Berkeluarga</label><br>
              <p style="background-color:#f1f1f1;">
                <input type="radio" name="jk" value="L" required> L
                <input type="radio" name="kel" value="S" required style="margin-left:25%;"> Sudah<br>
                <input type="radio" name="jk" value="P" required style="margin-left:2%"> P
                <input type="radio" name="kel" value="B" required style="margin-left:24%"> Belum
              </p>
            <label>Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="date" required><br>
          </div>
          <div class="rightforem" >    
            <label>Nama</label><br>
              <input type="text" name="nama" placeholder="Masukkan Nama"  required >
            <label>Alamat</label>
              <input type="text" name="alamat" placeholder="Massukkan Alamat" reuqired><br>
            <label style="float:left;">No. Telp</label><label style="padding-left: 36%;">Jabatan</label><br>
              <input type="text" name="no_t" placeholder="Masukkan No. Telp" required style="width:49%;float:left;">
              <select name="jab"  required style="width:49%;float:right; height:51px;margin-top:4px;">
                <option  style="display:none">Jabatan</option>
                <option value="MANAGER">MANAGER</option>
                <option value="ANALIS">ANALIS</option>
                <option value="PEGAWAI">PEGAWAI</option>
              </select>
          </div>   
          <input type="submit" name="simpan" value="SIMPAN" class="forembtn">
          <input type="reset" name="simpan" value="RESET" class="forembtnRE" >
        </form>
        <hr style="margin-left:8%;width:700px;">
      </div>
      <div class="card">
      <a><h2>Update Laporan</h2></a>
      <div class="row">
        <div class="gallery">

          <?php

            $no = 1;
            $query = "SELECT id_job,nip,nama_job,deadline FROM job WHERE ket='selesai' ORDER BY deadline ASC LIMIT 3 ";              
            $stmt = $n->kon->query($query);
          
            while ($data = $stmt->fetch_array())
            {
              echo
              "
              <div class=\"column\" id=$no style=\"width:225px;height:200px;\">
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
              <div class=\"column\" id=$no style=\"width:119px;height:200px;\">
                <a href=\"tampil.php\" style=\"color:#10b3ffb3;text-align:center;margin-top:68px;\">
                <h2>More</h2>
                </a>   
              </div>
              ";                        
          ?>  
                
        </div>
      </div>  
      </div>
      <div class="card">
        <a href="tampil.php"><h2> Data Pegawai</h2> </a>
        <table border="1" style="margin-left:-12px;margin-right:-12px;">
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Jabatan</th>
            <th>Gaji</th>
            <th colspan="4">Aksi</th>
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
              <td style='text-align:center'>$data[jk]</td>
              <td>$data[tgl_lahir]</td>
              <td>$data[alamat]</td>
              <td>$data[no_t]</td>
              <td>$data[jab]</td>
              <td>$data[gj_ttl]</td>
              <td>
                <a href='ngedit.php?id=$data[nip]' style='display=none;'><img src='../gal/lge.png'></a>
              </td>
              <td>
                <a href='hapus.php?id=$data[nip]' style='display=none;'><img src='../gal/lgh.png'></a>
              </td>
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
	    <div class="card"> 
	      <div class ="imgcontainer">
          <h5>W e l c o m e !</h5>
          <img src="../gal/avaA.png" class="avatar">
        	<h5><B> ADMIN </h5>
          AdWorker |</B><br>
        	Adalah sebuah perusahaan<br>
          <hr>
          <button onclick="document.getElementById('id01').style.display='block'" class="forembtn" 
           style="height:50px;width:80%;margin-top:-12px;" >
            <p style="font-size:20px;margin:11px -7px -7px 0px;" >Ubah Akun Admin</p>
          </button>
          <br>
          <hr>
        </div>
      </div>
  
      <div id="id01" class="modal">
        <form class="modal-content animate" method="POST" action="">
          <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" 
             title="Close Modal">&times;</span>
            <img src="../gal/avaA.png"  class="avatar">
          </div>
          <hr>
          <div class="containerH">
            <label><b>Username</b></label><br>
              <input type="text" placeholder="New Username" name="username" required>
            <br><br>
            <label><b>Password</b></label><br>
              <input type="text" placeholder="New Password" name="password" required>    
            <br><br>
            <button type="submit" class="tombol" name="editAdmin" ><h2>Simpan</h2></button>
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="tombolCL">
              <h2>Cancel</h2>
            </button>
            <br><br>
          </div>
        </form>
      </div>

      <div class="card">
        <h2>Notes</h2>
        <form method="post" action="">
          <input type="text" id="myInput" placeholder="Write Me" style="width:80%">
          <span onclick="newElement()" id="myInput" class="forembtn" 
            style="width:20%;font-height:50px;font-size:18px;padding:14px 5px 14px 6px;">
            Add</span>
        </form>
        <ul id="myUL">
          <li>Note Tidak</li>
          <li class="checked">Akan</li>
          <li>Tersimpan</li>
          <li>Fitur Percobaan</li>
          <li class="checked">Belum Fix</li>
          <li>But,You should Try</li>
          <li>Is Coming Soon</li>
        </ul>
      </div>
      <div class="card">
        <h2> Whats New</h2>
	       <div class="fakeimg"><a href="#.php">Update 1</a></div>
         <div class="fakeimg"><a href="#.php">Update 2</div></a>
         <div class="fakeimg"><a href="#.php">Update 3</div></a>
	       <div class="fakeimg"><a href="#.php">See All Update</div></a>
      </div>
    </div>
  </div>
  <div class ="row">
    <div class=	"card">
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
  //Dropdown hilang
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
  //notelist
  var myNodelist = document.getElementsByTagName("LI");
  var i;
  for (i = 0; i < myNodelist.length; i++) 
  {
    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    myNodelist[i].appendChild(span);
  }

  // Close button
  var close = document.getElementsByClassName("close");
  var i;
  for (i = 0; i < close.length; i++) 
  {
    close[i].onclick = function() 
    {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }

  // Checked
  var list = document.querySelector('ul');
  list.addEventListener('click', function(ev) 
  {
    if (ev.target.tagName === 'LI') 
    {
      ev.target.classList.toggle('checked');
    }
  }, false);

  //  new list item 
  function newElement() 
  {
    var li = document.createElement("li");
    var inputValue = document.getElementById("myInput").value;
    var t = document.createTextNode(inputValue);
    li.appendChild(t);
    if (inputValue === '') 
    {
      alert("You must write something!");
    } 
    else 
    {
      document.getElementById("myUL").appendChild(li);
    }
    document.getElementById("myInput").value = "";

    var span = document.createElement("SPAN");
    var txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);

    for (i = 0; i < close.length; i++) 
    {
      close[i].onclick = function() 
      {
        var div = this.parentElement;
        div.style.display = "none";
      }
    }
  }

</script>

</body>
</html>
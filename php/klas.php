<?php
/*
1.umum
2.tampil
3.cari 
4.dapat data
5.create data
6.login
7.hapus
8.edit
*/
include_once"config.php";
class Klas
{
    public $kon;
    
    public function __construct()
    
    {
        $database = new Database();
        $db = $database->Konek();
        $this->kon = $db;
    }

                            public function tampilPeg()
                            
                            {
                                $query = "SELECT * FROM pegawai";
                                $stmt = $this->kon->query($query);
                                $no = 1;
                                while ($data = $stmt->fetch_assoc())
                                {
                                    echo "<tr>
                                    <td style='text-align:center'>$no </td>
                                    <td>$data[nip]</td>
                                    <td>$data[nama]</td>
                                    <td style='text-align:center'>$data[jk]</td>
                                    <td>$data[tgl_lahir]</td>
                                    <td>$data[alamat]</td>
                                    <td>$data[no_t]</td>
                                    <td>$data[jab]</td></tr>";
                                    $no++;
                                }   
                            }

                            public function tampilPeg2()
                            
                            {
                                $query = "SELECT * FROM pegawai";
                                $stmt = $this->kon->query($query);
                                $no = 1;
                                while ($data = $stmt->fetch_assoc())
                                {
                                    echo "<tr>
                                    <td style='text-align:center'>$no </td>
                                    <td>$data[nama]</td>
                                    <td style='text-align:center'>$data[jk]</td>
                                    <td>$data[alamat]</td>
                                    <td>$data[no_t]</td>            
                                    <td>$data[jab]</td></tr>";
                                    $no++;
                                }   
                            }

                            public function tampilAkun()

                            {
                                $query = "SELECT * FROM akun ";
                                $stmt = $this->kon->query($query);
                                $no = 1;
                                while ($data = $stmt->fetch_assoc()) {
                                    echo "<tr>
                                    <td style='text-align:center'>$no </td>
                                    <td>$data[akun_id]</td>
                                    <td>$data[nip]</td>
                                    <td>$data[username]</td>
                                    <td>$data[email]</td>
                                    </tr>";
                                    $no++;
                                }   
                            }

                            public function downloadJob($id_job)

                            {
                                $query = "SELECT detail,file_name,type,size FROM job WHERE id_job='$id_job' ";
                                $stmt = $this->kon->query($query);
                                $num = mysqli_num_rows($stmt);

                                if($num > 0)
                                {
                                    $result = mysqli_fetch_object($stmt);

                                    header("Content-Disposition:attachment;filename=".$result->file_name."");
                                    header("Content-length:".$result->size."");
                                    header("Content-type:".$result->type."");
                                    echo $result->detail;
                                }
                                else
                                {
                                    echo"File Tidak Valid";
                                }
                            }

                            public function downloadLap($id_job)

                            {
                                $query = "SELECT lap,file_name,type,size FROM lap WHERE id_job='$id_job' ";
                                $stmt = $this->kon->query($query);
                                $num = mysqli_num_rows($stmt);

                                if($num > 0)
                                {
                                    $result = mysqli_fetch_object($stmt);
                                    
                                    header("Content-Disposition:attachment;filename=".$result->file_name."");
                                    header("Content-length:".$result->size."");
                                    header("Content-type:".$result->type."");
                                    echo $result->lap;
                                }
                                else
                                {
                                    echo"File Tidak Valid";
                                }
                            }                        


    public function cariPeg($name)
    
    {
        $query= "SELECT * from pegawai WHERE nama LIKE '%$name%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        if ($dapat == 1)
        {
            header("location:ngedit.php?id=$_SESSION[nip]");
        }
        else
        {
            $msg = $name." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariPegB($nip)
    
    {
        $query= "SELECT * from pegawai WHERE  nip='$nip'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        if ($dapat == 1)
        {
            header("location:ngedit.php?id=$_SESSION[nip]");
        }
        else
        {
            $msg = $nip." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }
    
    public function cariGaj($nama)
    
    {
        $query= "SELECT * from pegawai WHERE  nama LIKE '%$nama%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        if ($dapat == 1)
        {
            header("location:nggaji.php?id=$_SESSION[nip]");
        }
        else
        {
            $msg = $nama." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariGajB($nip)
    
    {
        $query= "SELECT * from gaji WHERE  nip='$nip'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        if ($dapat == 1)
        {
            header("location:nggaji.php?id=$_SESSION[nip]");
        }
        else
        {
            $msg = $nip." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariJob($namaJob)
    
    {
        $query= "SELECT * from job WHERE nama_job LIKE '%$namaJob%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];     

        if ($dapat == 1)
        {
            header("location:lap.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }       
        else
        {
            $msg = $namaJob." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariJobB($id_job)
    
    {
        $query= "SELECT * from job WHERE  id_job LIKE '%$id_job%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];   

        if ($dapat == 1)
        {
            header("location:lap.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }
        else
        {
            $msg = $id_job." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }    

    public function cariJobG($namaJob)
    
    {
        $query= "SELECT * from job WHERE nama_job LIKE '%$namaJob%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];     

        if ($dapat == 1)
        {
            header("location:tampilJob.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }       
        else
        {
            $msg = $namaJob." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariJobGB($id_job)
    
    {
        $query= "SELECT * from job WHERE  id_job LIKE '%$id_job%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];   

        if ($dapat == 1)
        {
            header("location:tampilJob.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }
        else
        {
            $msg = $id_job." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariJobH($namaJob)
    
    {
        $query= "SELECT * from job WHERE nama_job LIKE '%$namaJob%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];     

        if ($dapat == 1)
        {
            header("location:tampilHapus.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }       
        else
        {
            $msg = $namaJob." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    public function cariJobHB($id_job)
    
    {
        $query= "SELECT * from job WHERE  id_job LIKE '%$id_job%'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        $user_data = $stmt->fetch_array();
        $_SESSION['nip'] = $user_data['nip'];
        $_SESSION['id_job'] = $user_data['id_job'];   

        if ($dapat == 1)
        {
            header("location:tampilHapus.php?id=$_SESSION[nip]&job=$user_data[id_job]");
        }
        else
        {
            $msg = $id_job." Tidak Terdaftar";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }  

                            public function dapatId($id)
                            
                            {
                                $query = "SELECT * FROM pegawai WHERE nip='$id'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_assoc();
                                return $dapat ; 
                            }

                            public function dapatGajiAwal($id)

                            {
                                $query = "SELECT * FROM gaji WHERE nip='$id'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_assoc();
                                return $dapat ; 
                            }

                                public function dapatAkun($id)

                            {
                                $query = "SELECT * FROM akun WHERE nip='$id'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_assoc();
                                return $dapat ; 
                            }

                               public function dapatUn($id)

                            {
                                $query = "SELECT username FROM akun WHERE nip='$id'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_assoc();
                                return $dapat ; 
                            }

                            public function dapatNIP($un)

                            {
                                $query = "SELECT nip FROM akun WHERE username = '$un'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }

                            public function lastNip()

                            {
                                $query = "SELECT nip FROM pegawai ORDER BY nip DESC LIMIT 1";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }

                            public function lastJob()

                            {
                                $query = "SELECT id_job FROM job ORDER BY id_job DESC LIMIT 1";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }


                            public function dapatNewJob($nip)

                            {
                                $query = "SELECT id_job,nip,nama_job,tgl_diberikan,deadline,ket FROM job WHERE nip='$nip' ORDER BY id_job DESC LIMIT 1";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }

                            public function dapatJob($job)

                            {
                                $query = "SELECT id_job,nip,nama_job,deadline,ket FROM job WHERE id_job='$job'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }

                            public function dapatLap($job)

                            {
                                $query = "SELECT id_job,tgl_setor,ket FROM lap WHERE id_job='$job'";
                                $stmt = $this->kon->query($query);
                                $dapat = $stmt->fetch_array();
                                return $dapat ;
                            }


    public function tambahPeg($nip, $nama, $jk, $tgl_lahir, $alamat, $no_t, $jab )
    
    {   
        $query = "INSERT INTO pegawai VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param( 'issssis', $nip, $nama, $jk, $tgl_lahir, $alamat, $no_t, $jab);
        $stmt->execute();
        return true; 
    }

    public function tambahJob($nip, $nama_job, $content, $tgl_diberikan, $deadline, $ket, $fileName, $fileType, $fileSize)
    
    {   
        $query = "INSERT INTO job (nip, nama_job, detail, tgl_diberikan, deadline, ket, file_name, type, size) VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param( 'isssssssi', $nip, $nama_job, $content, $tgl_diberikan, $deadline, $ket, $fileName, $fileType, $fileSize);
        $stmt->execute();
        return true;       
    }

    public function tambahLap($id_job, $tgl_setor, $ket, $content, $fileName, $fileType, $fileSize)
    
    {   
        $query = "INSERT INTO lap VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param( 'isssssi', $id_job, $tgl_setor, $ket, $content, $fileName, $fileType, $fileSize);
        $stmt->execute();
        return true;       
    }    

    public function isiGajiAwal($nip, $gj_p, $kel)

    {
        $query = "INSERT INTO gaji (nip, gj_p, kel)VALUES(?,?,?)";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param( 'iii', $nip,  $gj_p, $kel);
        $stmt->execute();
        return true;
    }    

    public function daftar($nip, $username, $email, $password)

    {
        $query= "SELECT * from pegawai WHERE  nip='$nip'";
        $stmt = $this->kon->query($query);
        $dapat = mysqli_num_rows($stmt);
        if($dapat == 1 )
        {
            $query= "SELECT * from akun WHERE  nip='$nip'";
            $stmt = $this->kon->query($query);
            $dapat = mysqli_num_rows($stmt);
            if($dapat == 0)
            {
                $query = "INSERT INTO akun (nip, username, email, password) VALUES(?,?,?,?)";
                $stmt = $this->kon->prepare($query);
                $stmt->bind_param('ssss', $nip, $username, $email, $password);
                $stmt->execute();
                if($stmt)
                {
                    $msg = "PENDAFTARAN BERHASIL";
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }
            }
            else
            {
                $msg = $nip." SUDAH ADA";
                echo "<script type='text/javascript'>alert('$msg');</script>";  
            }
        }
        else
        {
            $msg = $nip." TIDAK TERDAFTAR";
            echo "<script type='text/javascript'>alert('$msg');</script>";    
        }
    }                    

                       public function login($username, $password)

                        {       
                            $query= "SELECT * from akun WHERE  username='$username' AND password='$password'";
                            $stmt = $this->kon->query($query);
                            $user_data = $stmt->fetch_array();
                            $dapat = mysqli_num_rows($stmt);
                            $_SESSION['login'] = true;
                            $_SESSION['akun_id'] = $user_data['akun_id'];
                            $_SESSION['nip'] = $user_data['nip'];
                            if ($dapat == 1)
                            {
                                if($_SESSION['akun_id'] == 1101)
                                {
                                    header("location:admin/admin.php");
                                }
                                else
                                {
                       
                                    header("location:gawai/gawai.php?id=$_SESSION[nip]");

                                }           
                            }
                            else
                            {
                                $msg = "username / password tidak benar";
                                echo "<script type='text/javascript'>alert('$msg');</script>";
                            }
                        }

                        public function loginVisitor($username, $password)

                        {  
                            
                            $query= "SELECT * from akun WHERE  username='$username' AND password='$password'";
                            $stmt = $this->kon->query($query);
                            $user_data = $stmt->fetch_array();
                            $dapat = mysqli_num_rows($stmt);
                            $_SESSION['login'] = true;
                            $_SESSION['akun_id'] = $user_data['akun_id'];
                            $_SESSION['nip'] = $user_data['nip'];
                            if ($dapat == 1)
                            {
                                if($_SESSION['akun_id'] == 1101)
                                {
                                    header("location:../admin/admin.php?id=1101");
                                }
                                else
                                {
                       
                                    header("location:../gawai/gawai.php?id=$_SESSION[nip]");

                                }           
                            }
                            else
                            {
                                $msg = "username / password tidak benar";
                                echo "<script type='text/javascript'>alert('$msg');</script>";
                            }
                       }



    public function hapusPeg($nip)
    
    {
        $query = "DELETE FROM pegawai WHERE nip=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param('i',$nip);
        $stmt->execute();
        return true;
    }


    public function hapusJob($id_job)
    
    {
        $query = "DELETE FROM job WHERE id_job=?";
        $stmt = $this->kon->prepare($query);
        $stmt->bind_param('i',$id_job);
        $stmt->execute();
        return true;
    }                             


                                    public function editPeg($nama, $jk, $tgl_lahir, $alamat, $no_t, $jab, $nip )
                                    
                                    {   
                                        $query = "UPDATE pegawai set nama=?,
                                                                jk=?,
                                                                tgl_lahir=?,
                                                                alamat=?,
                                                                no_t=?,
                                                                jab=?
                                                                WHERE nip=?";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->bind_param('ssssssi', $nama, $jk, $tgl_lahir, $alamat, $no_t, $jab, $nip);
                                        $stmt->execute();
                                        return true;
                                    }

                                    public function updateGaji($gj_p, $kel, $lembur, $bonus, $cuti, $gj_ttl, $nip)

                                    {
                                    $query = "UPDATE gaji set   gj_p=?,
                                                                kel=?,
                                                                lembur=?,
                                                                bonus=?,
                                                                cuti=?,
                                                                gj_ttl=?
                                                                WHERE nip=?";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->bind_param('iiiiiii', $gj_p, $kel, $lembur, $bonus, $cuti, $gj_ttl, $nip);
                                        $stmt->execute();
                                        return true;
                                    }

                                    public function ubahAkun( $username, $email,  $password, $akun_id, $nip  )
                                    
                                    {
                                        $query = "UPDATE akun set username=?,
                                                                email=?,
                                                                password=?,
                                                                akun_id=?
                                                                WHERE nip=?";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->bind_param('sssii', $username, $email,  $password, $akun_id, $nip  );
                                        $stmt->execute();
                                        return true;
                                    }

                                    public function ubahAdmin( $username, $password )
                                    
                                    {
                                        $query = "UPDATE akun set username=?,
                                                                password=?
                                                                WHERE akun_id='1101'";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->bind_param('ss', $username, $password );
                                        $stmt->execute();
                                        return true;
                                    }

                                    public function updateJob( $deadline, $tgl_setor, $ket, $id_job)

                                    {                                    
                                        $query = "UPDATE job set ket='selesai'
                                                                WHERE id_job='$id_job'";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->execute();
                                        return true;                                        
                                    }
                                    
                                    public function updateLap($id_job)

                                    {
                                        $query = "UPDATE lap set ket='selesai'  
                                                                WHERE id_job='$id_job'";
                                        $stmt = $this->kon->prepare($query);
                                        $stmt->execute();
                                        return true;                                                                                 
                                    }     
}
?>
</html>
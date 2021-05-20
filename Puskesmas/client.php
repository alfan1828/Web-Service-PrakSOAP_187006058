<?php

    /*  
      ini_set('display_errors', true);
      error_reporting(E_ALL); 
     */
  
    require_once('lib/nusoap.php');
    $error  = '';
    $result = array();
    $response = '';
    $wsdl = "http://localhost/Puskesmas/server.php?wsdl";
    if(isset($_POST['sub'])){
        $nama_pasien = trim($_POST['nama_pasien']);
        if(!$nama_pasien){
            $error = 'nama_pasien tidak boleh kosong.';
        }

        if(!$error){
            //create client object
            $client = new nusoap_client($wsdl, true);
            $err = $client->getError();
            if ($err) {
                echo '<h2>Ada Kesalahan</h2>' . $err;
                // At this point, you know the call that follows will fail
                exit();
            }
             try {
                $result = $client->call('fetchpasienData', array($nama_pasien));
                $result = json_decode($result);
              }catch (Exception $e) {
                echo 'Pengecualian Terbaca : ',  $e->getMessage(), "\n";
             }
        }
    }   

    /* Add new pasien **/
    if(isset($_POST['addbtn'])){
        $alamat = trim($_POST['alamat']);
        $nama_pasien = trim($_POST['nama_pasien']);
        $author = trim($_POST['author']);
        $obat = trim($_POST['obat']);
        $poli = trim($_POST['poli']);

        //Perform all required validations here
        if(!$nama_pasien || !$alamat || !$author || !$obat || !$poli){
            $error = 'Semua kolom yang diperlukan.';
        }

        if(!$error){
            //create client object
            $client = new nusoap_client($wsdl, true);
            $err = $client->getError();
            if ($err) {
                echo '<h2>Ada Kesalahan</h2>' . $err;
                // At this point, you know the call that follows will fail
                exit();
            }
             try {
                /** Call insert pasien method */
                 $response =  $client->call('insertpasien', array($alamat, $author, $poli, $nama_pasien, $obat));
                 $response = json_decode($response);
              }catch (Exception $e) {
                echo 'Pengecualian Terbaca : ',  $e->getMessage(), "\n";
             }
        }
    }

   

?>


<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien Puskesmas</title>
    <link rel="shortcut icon" href="favicon.icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">

        <br>
        <h1 class="text-center card mt-100 ml-5 mr-5 card-header bg-info text-white">Data Pasien 
            <br>Puskesmas Tasikmalaya
        </h1>
     
        <br>
        <div class="row ml-5">
            <form class="form-inline" method = 'post' name='form1'>
                <?php if($error) { ?> 
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong>&nbsp;<?php echo $error; ?> 
                    </div>
                <?php } ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Ketikkan Nama Pasien" required>
                </div> 
                <button type="submit" name='sub' class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg> Cari</button>
            </form>
        </div>

        <!-- Awal Card Tabel -->
       
         
<div class="card mt-3 ml-5 mr-5">
          <div class="card-header bg-info text-white">
            Informasi Data Pasien
          </div>
          <div class="card-body">
            <table class="table table-bordered bg-info">
                <thead class="table-primary ">
                    <tr>
                         <th class="text-center">Nama Pasien</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Keluhan</th>
                        <th class="text-center">Poli</th>
                        <th class="text-center">Obat</th>
                    </tr>
                </thead>
                   </div>
                <tbody>
                    <?php if($result){ ?>
                        <tr>
                            <td class="text-center"><?php echo $result->nama_pasien; ?></td> 
                            <td class="text-center"><?php echo $result->alamat; ?></td>
                            <td class="text-center"><?php echo $result->keluhan; ?></td>
                            <td class="text-center"><?php echo $result->poli; ?></td>
                            <td class="text-center"><?php echo $result->obat; ?></td>
                        </tr>
                        <?php 
                    }else { ?>
                    <tr>
                        <td colspan='5' class="text-center">Ketikkan <strong>Nama Pasien</strong> dan Klik <strong>Tombol Cari</strong></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>

          </div>
        </div><br><br>
        <!-- Akhir Card Tabel -->

        <!-- Awal Card Form -->
    
          <div colspan='5' class="text-center card mt-100 ml-5 mr-5 bg-info card-header text-white">
           
            <footer class="text-center">

            Formulir Data Pasien 
          </div>
          </footer>

          <div class="card-body"  >

          <?php if(isset($response->status)) {

                if($response->status == 200){ ?>
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong>&nbsp; pasien Added succesfully. 
                    </div>
                <?php }elseif(isset($response) && $response->status != 200) { ?>
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong>&nbsp; Cannot Add a pasien. Please try again. 
                    </div>
                <?php } 
            }
            ?>

          <div class="card-body">
            <form method="post" name='form1'>
                <?php if($error) { ?> 
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong>&nbsp;<?php echo $error; ?> 
                    </div>
                <?php } ?>
                  <div class="form-group">
               
                    <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="Masukan Nama Pasien" required>
                </div>
                <div class="form-group">
                
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat" required>
                </div>
                <div class="form-group">
          
                    <input type="text" name="author" id="author" class="form-control" placeholder="Masukan Keluhan" required>
                </div>
                <div class="form-group">
        
                    <input type="text" name="poli" id="poli" class="form-control" placeholder="Masukan Poli" required>
                </div>
                <div class="form-group">
            
                    <input type="text" name="obat" id="obat" class="form-control" placeholder="Masukan Obat" required>
                </div>

                <button type="submit" name='addbtn' class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg> Simpan</button>
            </form>
          </div>
        </div>
        <!-- Akhir Card Form -->
    </div><br><br>

    <footer class="text-center">
        <p> ©Copyright Web Services SOAP With Library NuSOAP</p>
        <p>
    </p>
    </footer>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>
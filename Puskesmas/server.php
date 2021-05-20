<?php

   require_once('dbconn.php');
   require_once('lib/nusoap.php'); 
   $server = new nusoap_server();


  function insertpasien($alamat, $keluhan, $poli, $nama_pasien, $obat){
    global $dbconn;
    $sql_insert = "insert into pasien (alamat, keluhan, poli, nama_pasien, obat) values ( :alamat, :keluhan, :poli, :nama_pasien, :obat)";
    $stmt = $dbconn->prepare($sql_insert);
    $result = $stmt->execute(array(':alamat'=>$alamat, ':keluhan'=>$keluhan, ':poli'=>$poli, ':nama_pasien'=>$nama_pasien, ':obat'=>$obat));
    if($result) {
      return json_encode(array('status'=> 200, 'msg'=> 'success'));
    }
    else {
      return json_encode(array('status'=> 400, 'msg'=> 'fail'));
    }
    
    $dbconn = null;
    }

  function fetchpasienData($nama_pasien){
  	global $dbconn;
  	$sql = "SELECT id, alamat, keluhan, poli, nama_pasien, obat FROM pasien 
  	        where nama_pasien = :nama_pasien";
      $stmt = $dbconn->prepare($sql);
      $stmt->bindParam(':nama_pasien', $nama_pasien);
      $stmt->execute();
      $data = $stmt->fetch(PDO::FETCH_ASSOC);
      return json_encode($data);
      $dbconn = null;
  }
  $server->configureWSDL('Web Service SOAP Puskesmas', 'urn:pasien');
  $server->register('fetchpasienData',
  			array('nama_pasien' => 'xsd:string'),  
  			array('data' => 'xsd:string'),  
  			'urn:pasien',   
  			'urn:pasien#fetchpasienData' 
        );  
        $server->register('insertpasien',
  			array('alamat' => 'xsd:string', 'keluhan' => 'xsd:string', 'poli' => 'xsd:string', 'nama_pasien' => 'xsd:string', 'obat' => 'xsd:string'),  
  			array('data' => 'xsd:string'),  
  			'urn:pasien',   
  			'urn:pasien#fetchpasienData' 
  			);  
  $server->service(file_get_contents("php://input"));

?>

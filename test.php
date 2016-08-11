<?php
  require_once "JsonORM.php";

  $jsonOrm = new JsonORM();
  $jsonOrm->setFile('localidades.json');


  $resp = $jsonOrm->where('nombre', "localidad4" )->findMany();

  $resp = $jsonOrm->like('nombre', "bara")->findMany();
  var_dump($resp);

?>

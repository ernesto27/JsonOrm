<?php

class JsonORM
{
  /** @var string */
  private $jsonFile;
  /** @var array */
  private $jsonEncode;
  /** @var json */
  private $response;


  /**
   * @param string $jsonFile
   * @return Object
   */
  public function setFile($jsonFile)
  {
    $this->jsonFile = $jsonFile;
    $this->getFile();
    //var_dump($this->jsonEncode);
    return $this;
  }

  /**
   * @param string $field
   * @param string $value
   * @return Object
   */
  public function where($field, $value)
  {
    $resp = array();
    foreach ($this->jsonEncode as $key => $item) {
      if($item->$field == $value){
        $resp[] = $item;
      }
    }
    $this->response = $resp;
    return $this;
  }

  public function like($field, $query)
  {
    $this->response = [];
    $resp = array();
    foreach ($this->jsonEncode as $key => $item) {
      $string = $item->$field;
      //$string = strtolower($string);
      $res = str_replace(array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ'), array('a','e','i','o','u','n','A','E','I','O','U','Ñ'), trim($string));

      if(stristr($res, $query)){
        $resp[] = $item;
      }
    }
    $this->response = $resp;
    return $this;
  }

  public function findMany()
  {
    return $this->response;
  }

  // protected methods
  protected function getFile()
  {
    // Todo add try catch
    $file = file_get_contents($this->jsonFile);
		$this->jsonEncode = json_decode($file);
  }

}

?>

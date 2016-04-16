<?

class Phones
{


  public function getPhones(){
    $result = $this->getPhonesFromDb();
    while ($obj = $result->fetch_object()) {
      $phones[] = $obj;
    }
    return $phones;
  }

  private function dbQuery($query){
    $mysqli = new mysqli('localhost', 'root', '', 'phonebook');
    $result = $mysqli->query($query);
    $mysqli->close();
    return $result;
  }

  private function getPhonesFromDb(){
    return $this->dbQuery("SELECT * FROM phonebook");
  }

  private function addPhones($data){
    $fields = array_map(function($value) {return "'{$value}'";}, $data);
    $fields = implode(',', $fields);
    $query = "INSERT INTO `phonebook`.`phonebook` (`id`, `fio`, `address`, `phone`) VALUES (NULL, $fields);";
    $this->dbQuery($query);
  }
}

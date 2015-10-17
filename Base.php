<?php
session_start();


class Base {
  private $regno;
  private $name;

  private $mysql_hostname;
  private $mysql_dbname;
  private $mysql_username;
  private $mysql_password;

  public function Init() {
    $this->mysql_hostname = 'localhost';
    $this->mysql_dbname   = 'auth_db';
    $this->mysql_username = 'root';
    $this->mysql_password = 'password';
  }

  public function AddUser($regno, $pass, $name) {
    $dbh = new PDO("mysql:host=$this->mysql_hostname;dbname=$this->mysql_dbname", $this->mysql_username, $this->mysql_password);
    try {
      /*** set the error mode to excptions ***/
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /*** prepare the insert ***/
      $stmt = $dbh->prepare("INSERT INTO `auth_data` (regno, pass, name) VALUES (:regno, :pass, :name )");

      /*** bind the parameters ***/
      $stmt->bindParam(':regno', $regno,     PDO::PARAM_STR, 10);
      $stmt->bindParam(':pass', sha1($pass), PDO::PARAM_STR, 40);
      $stmt->bindParam(':name', $name,       PDO::PARAM_STR, 30);

      /*** execute the prepared statement ***/
      $stmt->execute();
    } catch(Exception $e) {
      /*** check if the username already exists ***/
      if( $e->getCode() == 23000) {
        return -1;
      } else {
        return -2;
      }
    } // catch
    return 0;
  } // AddUser

  public function getLogin($regno, $pass) {
    $dbh = new PDO("mysql:host=$this->mysql_hostname;dbname=$this->mysql_dbname", $this->mysql_username, $this->mysql_password);
    try {
      /*** set the error mode to excptions ***/
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /*** prepare the insert ***/
      $stmt = $dbh->prepare("SELECT regno, pass, name FROM auth_data
                    WHERE regno = :regno AND pass = :pass");

      /*** bind the parameters ***/
      $stmt->bindParam(':regno', $regno,     PDO::PARAM_STR, 10);
      $stmt->bindParam(':pass', sha1($pass), PDO::PARAM_STR, 40);

      /*** execute the prepared statement ***/
      $stmt->execute();

      /*** check for a result ***/
      $user_data = $stmt->fetch();

      if ($user_data == false) {
        return -1; // invalid username/pass
      }

      // set session data
      $_SESSION['user_data'] = $user_data;
      return 0;

    } catch(Exception $e) {
      return -2; // unknown
    } // catch
    return -1; // invalid username/pass
  } //getLogin

}


?>

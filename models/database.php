<?php
class Database
{
  private $host = "localhost";
  private $user = "root";
  private $pwd = "";
  private $dbName = "pet_shop";


  public function connect()
  {
    $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbName;
    $pdo = new PDO($dsn, $this->user, $this->pwd);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
  }

  protected function checkUserName($data) // Check if username is valid
  {
    $sql = "SELECT * FROM users WHERE userName = :user";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['user' => $data['user']]);

    return $stmt->rowCount() > 0 ? true : false;
  }

  protected function checkPassword($data) // Check if password is valid
  {
    $sql = "SELECT * FROM users WHERE userName = :user AND password = :password";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['user' => $data['user'], 'password' => $data['password']]);

    return $stmt->rowCount() > 0 ? true : false;
  }

  protected function loginUser($data = [], $type = 0)
  {
    // Type = 0 -> Used to Login the User
    // Type = 1 -> Get User Data

    if ($type == 0 OR $type == 1)
    {
      $user = [];

      $sql = "SELECT * FROM users";
    }
    else if ($type == 2)
    {
      $sql = "SELECT COUNT(*) AS countUsers FROM users";
    }
    else if ($type == 3)
    {
      $sql = "UPDATE users SET userName = :user, password = :pass WHERE randomId = :randomId";
    }
    
    if ($type == 0)
    {
      $sql .= " WHERE userName = :user AND password = :password";
    }
    else if ($type == 1)
    {
      $sql .= " WHERE randomId = :randomId";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute(['user' => $data['user'], 'password' => $data['password']]);
    }
    else if ($type == 1)
    {
      $stmt->execute(['randomId' => $data['randomId']]);
    }
    else if ($type == 2)
    {
      $stmt->execute();
    }
    else if ($type == 3)
    {
      $stmt->execute(['user' => $data['user'], 'pass' => $data['password'], 'randomId' => $data['randomId']]);
    }

    if ($type == 0 OR $type == 1)
    {
      while ($row = $stmt->fetch()) 
      {
        $user[] = $row;
      }

      return $user;
    }
    else if ($type == 2)
    {
      $row = $stmt->fetch();

      return $row['countUsers'];
    }
    else if ($type == 3)
    {
      return $stmt->rowCount() > 0 ? true : false;
    }
  }

  protected function employeeDetails($userId = "", $type = 0, $data = []) // Query to get the employee details
  {
    $values = [];

    if ($type == 0)
    {
      $sql = "SELECT * FROM employeedetails WHERE id = :userId";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(['userId' => $userId]);
    }
    else if ($type == 1)
    {
      $sql = "SELECT
              e.id, 
              e.firstName, 
              e.middleName, 
              e.lastName,
              e.gender,
              e.emailAddress,
              e.phoneNumber,
              e.hiredDate,
              e.location,
              e.province,
              e.municipality,
              p.positionName
              FROM employeedetails e
              LEFT JOIN position p ON p.id = e.positionId";

      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
    }
    else if ($type == 2)
    {
      $sql = "INSERT INTO employeedetails (firstName, middleName, lastName, gender, emailAddress, phoneNumber, positionId, hiredDate, location, province, municipality)
              VALUES (:firstName, :middleName, :lastName, :gender, :email, :phoneNumber, :position, :hiredDate, :location, :province, :municipality)";
      $stmt = $this->connect()->prepare($sql);

      $stmt->execute([
        'firstName'     => $data['firstname'],
        'middleName'    => $data['middleName'],
        'lastName'      => $data['lastname'],
        'gender'        => $data['gender'],
        'email'         => $data['email'],
        'phoneNumber'   => $data['phonenumber'],
        'position'      => $data['position'],
        'hiredDate'     => $data['dateHired'],
        'location'      => $data['address'],
        'province'      => $data['province'],
        'municipality'  => $data['city']
      ]);
    }
    else if ($type == 3)
    {
      $sql = "UPDATE employeeDetails SET firstName = :firstname, middleName = :middleName, 
              lastName = :lastname, gender = :gender, emailAddress = :email, 
              phoneNumber = :phonenumber, positionId = :position, hiredDate = :dateHired, 
              location = :address, province = :province, municipality = :city 
              WHERE id = :id";
      $stmt = $this->connect()->prepare($sql);

      $stmt->execute([
        'firstname'     => $data['firstname'],
        'middleName'    => $data['middleName'],
        'lastname'      => $data['lastname'],
        'gender'        => $data['gender'],
        'email'         => $data['email'],
        'phonenumber'   => $data['phonenumber'],
        'position'      => $data['position'],
        'dateHired'     => $data['dateHired'],
        'address'       => $data['address'],
        'province'      => $data['province'],
        'city'          => $data['city'],
        'id'            => $data['id']
      ]);
    }
    else if ($type == 4)
    {
      $sql = "SELECT COUNT(*) AS total FROM employeedetails";
      $stmt = $this->connect()->prepare($sql);
    }
    else if ($type == 5)
    {
      $sql = "UPDATE employeeDetails SET firstName = :firstname, middleName = :middleName, 
              lastName = :lastname, gender = :gender, emailAddress = :email, 
              phoneNumber = :phonenumber, hiredDate = :dateHired, 
              location = :address, province = :province, municipality = :city 
              WHERE id = :id";
      $stmt = $this->connect()->prepare($sql);

      $stmt->execute([
        'firstname'     => $data['firstname'],
        'middleName'    => $data['middleName'],
        'lastname'      => $data['lastname'],
        'gender'        => $data['gender'],
        'email'         => $data['email'],
        'phonenumber'   => $data['phonenumber'],
        'dateHired'     => $data['dateHired'],
        'address'       => $data['address'],
        'province'      => $data['province'],
        'city'          => $data['city'],
        'id'            => $data['id']
      ]);
    }

    if ($type == 0 OR $type == 1)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type != 4)
    {
      return $stmt->rowCount() > 0 ? true : false;
    }
    else if ($type == 4)
    {
      $stmt->execute();
      $row = $stmt->fetch();
      return $row['total'];
    }
  }

  protected function userTable() // Query to get the user's table
  {
    $data = [];

    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) 
    {
      $data[] = $row;
    }

    return $data;
  }

  protected function position($posId, $type) // Query to get the user's position
  {
    $data = [];

    $sql = "SELECT * FROM position";

    if ($type == 0)
    {
      $sql .= " WHERE id = :posId";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute(['posId' => $posId]);

      return $stmt->fetch()['positionName'];
    }
    else if ($type == 1)
    {
      $stmt->execute();

      while ($row = $stmt->fetch()) 
      {
        $data[] = $row;
      }

      return $data;
    }
  }

  protected function accessFields($typeId) // Query to get the user's access fields
  {
    $sql = "SELECT type, accessType FROM type WHERE id = :typeId";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(['typeId' => $typeId]);

    return $stmt->fetchAll();
  }

  protected function customerDetails($type = 0, $data = []) // Query for Customer Table
  {
    if ($type == 0)
    {
      $sql = "SELECT * FROM customer";

      if (count($data) > 0)
      {
        $sql .= " WHERE id = :id";
      }
    }
    else if ($type == 1)
    {
      $sql = "INSERT INTO customer (firstName, lastName, phoneNumber) VALUES (:firstName, :lastName, :phoneNumber)";
    }
    else if ($type == 2)
    {
      $sql = "UPDATE customer SET firstName = :firstName, lastName = :lastName, phoneNumber = :phoneNumber WHERE id = :id";
    }
    else if ($type == 3)
    {
      $sql = "SELECT COUNT(*) AS customerCount FROM customer";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      if (count($data) > 0)
      {
        $stmt->execute(['id' => $data['id']]);
      }
      else
      {
        $stmt->execute();
      }
    }
    else if ($type == 1)
    {
      $stmt->execute(['firstName' => $data['firstName'], 'lastName' => $data['lastName'], 'phoneNumber' => $data['phoneNumber']]);
    }
    else if ($type == 2)
    {
      $stmt->execute(['firstName' => $data['firstName'], 'lastName' => $data['lastName'], 'phoneNumber' => $data['phoneNumber'], 'id' => $data['id']]);
    }
    else if ($type == 3)
    {
      $stmt->execute();
    }

    if ($type == 0)
    {
      $data = [];

      while ($row = $stmt->fetch()) 
      {
        $data[] = $row;
      }

      return $data;
    }
    else if ($type == 1)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 2)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 3)
    {
      return $stmt->fetch()['customerCount'];
    }
  }
}

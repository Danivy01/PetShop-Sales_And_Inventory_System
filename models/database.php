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

  protected function randomString()
  {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10 / strlen($x)))), 1, 10);
  }

  protected function transactionNumber()
  {
    return substr(str_shuffle(str_repeat($x = '0123456789', ceil(10 / strlen($x)))), 1, 10);
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

    if ($type == 0 OR $type == 1 OR $type == 4)
    {
      $user = [];

      $sql = "SELECT * FROM users";
    }
    else if ($type == 2)
    {
      $sql = "SELECT COUNT(*) AS countUsers FROM users";
    }
    else if ($type == 3 OR $type == 5)
    {
      $sql = "UPDATE users SET userName = :user, password = :pass";
    }
    else if ($type == 6)
    {
      $sql = "DELETE FROM users WHERE userId = :id";
    }
    
    if ($type == 0)
    {
      $sql .= " WHERE userName = :user AND password = :password";
    }
    else if ($type == 1)
    {
      $sql .= " WHERE randomId = :randomId";
    }
    else if ($type == 3)
    {
      $sql .= "  WHERE randomId = :randomId";
    }
    else if ($type == 4)
    {
      $sql .= " WHERE userId = :userId";
    }
    else if ($type == 5)
    {
      $sql .= " WHERE userId = :userId";
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
    else if ($type == 4)
    {
      $stmt->execute(['userId' => $data['userId']]);
    }
    else if ($type == 5)
    {
      $stmt->execute(['user' => $data['user'], 'pass' => $data['password'], 'userId' => $data['userId']]);
    }
    else if ($type == 6)
    {
      $stmt->execute(['id' => $data['id']]);
    }

    if ($type == 0 OR $type == 1 OR $type == 4)
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
    else if ($type == 3 OR $type == 5 OR $type == 6)
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
    else if ($type == 6)
    {
      $sql = "SELECT id, CONCAT(firstName, ' ', middleName, ' ', lastName) AS fullName
              FROM employeedetails WHERE id NOT IN (SELECT userId FROM users)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
    }

    if ($type == 0 OR $type == 1 OR $type == 6)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 2 OR $type == 3)
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

  protected function userTable($type = 0, $data = []) // Query to get the user's table
  {
    $values = [];

    if ($type == 0)
    {
      $sql = "SELECT * FROM users";
    }
    else if ($type == 1)
    {
      $sql = "INSERT INTO users (randomId, userName, password, typeId, userId)
              VALUES (:randomId, :userName, :password, :typeId, :userId)";
    }
    
    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute();

      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 1)
    {
      $stmt->execute([
        'randomId'  => $this->randomString(),
        'userName'  => $data['userName'],
        'password'  => $data['password'],
        'typeId'    => $data['typeId'],
        'userId'    => $data['userId']
      ]);

      return $stmt->rowCount() > 0 ? true : false;
    }
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

  protected function accessFields($typeId = "", $type = 0) // Query to get the user's access fields
  {
    $sql = "SELECT id, type, accessType FROM type";

    if ($type == 0)
    {
      $sql .= " WHERE id = :typeId";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute(['typeId' => $typeId]);

    }
    else if ($type == 1)
    {
      $stmt->execute();
    }

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
    else if ($type == 1 OR $type == 2)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 3)
    {
      return $stmt->fetch()['customerCount'];
    }
  }

  protected function supplierDetails($type = 0, $data = [])
  {
    if ($type == 0 OR $type == 2)
    {
      $sql = "SELECT * FROM supplier";

      if ($type == 2)
      {
        $sql .= " WHERE supplier_id = :id";
      }
    }
    else if ($type == 1)
    {
      $sql = "INSERT INTO supplier (companyName, province, city, phoneNumber)
              VALUES (:companyName, :province, :city, :phoneNumber)";
    }
    else if ($type == 3)
    {
      $sql = "UPDATE supplier SET companyName = :companyName, province = :province, city = :city, phoneNumber = :phoneNumber WHERE supplier_id = :id";
    }
    else if ($type == 4)
    {
      $sql = "SELECT COUNT(*) AS supplierCount FROM supplier";
    }
    else if ($type == 5)
    {
      $sql = "DELETE FROM supplier WHERE supplier_id = :id";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0 OR $type == 4)
    {
      $stmt->execute();
    }
    else if ($type == 1)
    {
      $stmt->execute([
        'companyName' => $data['companyName'],
        'province'    => $data['province'],
        'city'        => $data['city'],
        'phoneNumber' => $data['phoneNumber']
      ]);
    }
    else if ($type == 2 OR $type == 5)
    {
      $stmt->execute(['id' => $data['id']]);
    }
    else if ($type == 3)
    {
      $stmt->execute([
        'companyName' => $data['companyName'],
        'province'    => $data['province'],
        'city'        => $data['city'],
        'phoneNumber' => $data['phoneNumber'],
        'id'          => $data['id']
      ]);
    }

    if ($type == 0 OR $type == 2)
    {
      $values = [];

      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 1 OR $type == 3 OR $type == 5)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 4)
    {
      return $stmt->fetch()['supplierCount'];
    }
  }

  protected function categoryDB($type = 0, $data = [])
  {
    $values = [];

    if ($type == 0 OR $type == 1)
    {
      $sql = "SELECT * FROM category";

      if ($type == 1)
      {
        $sql .= " WHERE id = :id";
      }
    }
    else if ($type == 2)
    {
      $sql = "INSERT INTO category (categoryName, status) VALUES (:categoryName, :status)";
    }
    else if ($type == 3)
    {
      $sql = "UPDATE category SET status = :status WHERE id = :id";
    }
    else if ($type == 4)
    {
      $sql = "DELETE FROM category WHERE id = :id";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      $stmt->execute();
    }
    else if ($type == 1 OR $type == 4)
    {
      $stmt->execute(['id' => $data['id']]);
    }
    else if ($type == 2)
    {
      $stmt->execute(['categoryName' => $data['categoryName'], 'status' => $data['status']]);
    }
    else if ($type == 3)
    {
      $stmt->execute(['status' => $data['status'], 'id' => $data['id']]);
    }

    if ($type == 0 OR $type == 1)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 2 OR $type == 3 OR $type == 4)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
  }

  protected function productDB($type = 0, $data = [])
  {
    $values = [];

    if ($type == 0 OR $type == 1 OR $type == 3)
    {
      $sql = "SELECT * FROM product";

      if ($type == 1)
      {
        $sql .= " WHERE product_id = :id";
      }
      else if ($type == 3)
      {
        $sql .= " ORDER BY product_id DESC LIMIT 5";
      }
    }
    else if ($type == 2)
    {
      $sql = "INSERT INTO product (productCode, productName, productDescription, qtyStock, onHand, price, category_id, supplier_id, date_stock_in)
              VALUES (:productCode, :productName, :productDescription, :qtyStock, :onHand, :price, :category_id, :supplier_id, :date_stock_in)";
    }
    else if ($type == 4)
    {
      $sql = "DELETE FROM product WHERE product_id = :id";
    }
    else if ($type == 5)
    {
      $sql = "SELECT COUNT(*) AS productCount FROM product";
    }
    else if ($type == 6)
    {
      $sql = "UPDATE product SET productName = :productName, productDescription = :productDescription, qtyStock = :qtyStock, onHand = :onHand, price = :price, category_id = :categoryId, supplier_id = :supplierId, date_stock_in = :dateStock WHERE product_id = :id";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0 OR $type == 3 OR $type == 4 OR $type == 5)
    {
      $stmt->execute();
    }
    else if ($type == 1)
    {
      $stmt->execute(['id' => $data['id']]);
    }
    else if ($type == 2)
    {
      $stmt->execute([
        'productCode'        => $data['productCode'],
        'productName'        => $data['productName'],
        'productDescription' => $data['productDescription'],
        'qtyStock'           => $data['stock'],
        'onHand'             => $data['onHand'],
        'price'              => $data['price'],
        'category_id'        => $data['category'],
        'supplier_id'        => $data['supplier'],
        'date_stock_in'      => date('Y-m-d H:i:s')
      ]);
    }
    else if ($type == 6)
    {
      $stmt->execute([
        'productName'        => $data['productName'],
        'productDescription' => $data['productDescription'],
        'qtyStock'           => $data['stock'],
        'onHand'             => $data['onHand'],
        'price'              => $data['price'],
        'categoryId'         => $data['categoryId'],
        'supplierId'         => $data['supplierId'],
        'id'                 => $data['id'],
        'dateStock'          => date('Y-m-d H:i:s')
      ]);
    }

    if ($type == 0 OR $type == 1 OR $type == 3)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 2 OR $type == 4 OR $type == 6)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 5)
    {
      return $stmt->fetch()['productCount'];
    }
  }

  protected function transactionDB($type = 0, $data = [])
  {
    if ($type == 0 OR $type == 7)
    {
      $sql = "SELECT * FROM transaction";

      if ($type == 7)
      {
        $sql .= " WHERE id = :id";
      }
    }
    else if ($type == 1)
    {
      $sql = "SELECT * FROM transactiondetails WHERE transactionId = :id";
    }
    else if ($type == 2)
    {
      $sql = "SELECT COUNT(*) AS transactionCount FROM transaction";
    }
    else if ($type == 3)
    {
      $sql = "SELECT COUNT(*) AS transactionCount FROM transactiondetails WHERE transactionId = :id";
    }
    else if ($type == 4)
    {
      $sql = "INSERT INTO transaction (transactionNumber, transactionDate, customerId, addedBy) VALUES (:transactionNumber, :transactionDate, :customerId, :addedBy)";
    }
    else if ($type == 5)
    {
      $sql = "INSERT INTO transactiondetails (transactionId, productId, quantity) VALUES (:transactionId, :productId, :qty)";
    }
    else if ($type == 6)
    {
      $sql = "SELECT id FROM transaction ORDER BY id DESC LIMIT 1";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0 OR $type == 2 OR $type == 6)
    {
      $stmt->execute();
    }
    else if ($type == 1 OR $type == 3 OR $type == 7)
    {
      $stmt->execute(['id' => $data['id']]);
    }
    else if ($type == 4)
    {
      $stmt->execute([
        'transactionNumber' => $data['transactionNumber'],
        'transactionDate'   => $data['transactionDate'],
        'customerId'        => $data['customerId'],
        'addedBy'           => $data['addedBy']
      ]);
    }
    else if ($type == 5)
    {
      $stmt->execute([
        'transactionId' => $data['transactionId'],
        'productId'     => $data['productId'],
        'qty'           => $data['qty']
      ]);
    }

    $values = [];

    if ($type == 0 OR $type == 1 OR $type == 7)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else if ($type == 2 OR $type == 3)
    {
      return $stmt->fetch()['transactionCount'];
    }
    else if ($type == 4 OR $type == 5)
    {
      return ($stmt->rowCount() > 0) ? true : false;
    }
    else if ($type == 6)
    {
      return $stmt->fetch()['id'];
    }
  }
}

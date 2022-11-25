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

  protected function loginUser($data, $type = 0)
  {
    // Type = 0 -> Used to Login the User
    // Type = 1 -> Get User Data

    $user = [];

    $sql = "SELECT * FROM users";

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

    while ($row = $stmt->fetch()) 
    {
      $user[] = $row;
    }

    return $user;
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

    if ($type == 0 OR $type == 1)
    {
      while ($row = $stmt->fetch()) 
      {
        $values[] = $row;
      }

      return $values;
    }
    else
    {
      return $stmt->rowCount() > 0 ? true : false;
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
  }

  protected function productDetails($type = 0, $data = []) // Query for Product Table
  {
    if ($type == 0)
    {
      $sql = "SELECT * FROM product";

      if (count($data) > 0)
      {
        $sql .= " WHERE product_id = :product_id";
      }
    }
    else if ($type == 1)
    {
      $sql = "INSERT INTO product (productCode, productName, productDescription, qtyStock, onHand, price, category_id, supplier_id, date_stock_in)
      VALUES (:productCode, :productName, :productDescription, :qtyStock, :onHand, :price, :category_id, :supplier_id, :date_stock_in)";
    }
    else if ($type == 2)
    {
      $sql = "UPDATE product SET productCode = :productCode, productName = :productName, productDescription = :productDescription, qtyStock = :qtyStock,
       onHand = :onHand, price = :price, category_id = :category_id, supplier_id = :supplier_id, date_stock_in = :date_stock_in WHERE product_id = :product_id";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      if (count($data) > 0)
      {
        $stmt->execute(['product_id' => $data['product_id']]);
      }
      else
      {
        $stmt->execute();
      }
    }
    else if ($type == 1)
    {
      $stmt->execute(['productCode' => $data['productCode'], 'productName' => $data['productName'], 'productDescription' => $data['productDescription'], 'qtyStock' => $data['qtyStock'],
      'onHand' => $data['onHand'], 'price' => $data['price'], 'category_id' => $data['category_id'], 'supplier_id' => $data['supplier_id'], 'date_stock_in' => $data['date_stock_in']]);
    }
    else if ($type == 2)
    {
      $stmt->execute(['productCode' => $data['productCode'], 'productName' => $data['productName'], 'productDescription' => $data['productDescription'], 'qtyStock' => $data['qtyStock'], 
      'onHand' => $data['onHand'], 'price' => $data['price'], 'category_id' => $data['category_id'], 'supplier_id' => $data['supplier_id'], 'date_stock_in' => $data['date_stock_in'], 'product_id' => $data['product_id']]);
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
  }

  protected function supplierDetails($type = 0, $data = []) // Query for Supplier Table
  {
    if ($type == 0)
    {
      $sql = "SELECT * FROM supplier";

      if (count($data) > 0)
      {
        $sql .= " WHERE supplier_id = :supplier_id";
      }
    }
    else if ($type == 1)
    {
      $sql = "INSERT INTO supplier (companyName, province, city, phoneNumber) VALUES (:companyName, :province, :city, :phoneNumber)";
    }
    else if ($type == 2)
    {
      $sql = "UPDATE supplier SET companyName = :companyName, province = :province, city = :city, phoneNumber = :phoneNumber WHERE supplier_id = :supplier_id";
    }

    $stmt = $this->connect()->prepare($sql);

    if ($type == 0)
    {
      if (count($data) > 0)
      {
        $stmt->execute(['supplier_id' => $data['supplier_id']]);
      }
      else
      {
        $stmt->execute();
      }
    }
    else if ($type == 1)
    {
      $stmt->execute(['companyName' => $data['companyName'], 'province' => $data['province'],'city' => $data['city'], 'phoneNumber' => $data['phoneNumber']]);
    }
    else if ($type == 2)
    {
      $stmt->execute(['companyName' => $data['companyName'], 'province' => $data['province'],'city' => $data['city'], 'phoneNumber' => $data['phoneNumber'], 'supplier_id' => $data['supplier_id']]);
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
  }
}


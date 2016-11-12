<?php
//
// db_functions.php
//
// NB. Using prepared statements "helps to prevent SQL injection attacks by eliminating the need to
// manually quote the parameters."
//

/* CREATE STUDENT
 * create_student(): inserts a new student into student table
 * returns 0 if product successfully created
 *         1062 if student already exists
 *         error code if other db/sql error
 */
function create_student($studID, $studPassword, $studFName, $studLName, $currentYear, $major, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Insert the new product into the the Product table
    $sql = "INSERT INTO Student
              (studentID, studentPassword, studentFName, studentLName, currentYear, major)
            VALUES
              (:studID, :studPassword, :studFName, :studLName, :currentYear, :major);";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':studID', $studentID);
    $sth->bindParam(':studPassword', $descript);
    $sth->bindParam(':studFName', $studFName);
    $sth->bindParam(':studLName', $studLName);
    $sth->bindParam(':currentYear', $currentYear);

    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // student successfully created
    else
      return -1;  // student not created; this case may not be possible
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "A student with this code already exists.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}

/* READ PRODUCT
 * read_product(): reads a product from product table given its product code
 * returns 0 if product successfully deleted
 *         -1 if product does not exist
 *         error code if other db/sql error
 */
function read_product($pcode, &$descript, &$date, &$qoh, &$min, &$price, &$discount, &$vcode, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT Description, Indate, QuantityOnHand, MinQuantityOnHand,
                   Price, DiscountRate, VendorCode
            FROM Product
            WHERE ProductCode = :pcode;";

    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $sth->bindParam(':pcode', $pcode);
    // Execute the prepared query.
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;

    // Check whether the submitted product already exists
    if (count($array) == 0)
    {
      // no product found
      $error_msg = "A product with this code does not exist.";
      return -1;
    }
    else
    {
      $record = $array[0];
      $descript = $record['Description'];
      $date = $record['Indate'];
      $qoh =  $record['QuantityOnHand'];
      $min =  $record['MinQuantityOnHand'];
      $price = $record['Price'];
      $discount = $record['DiscountRate'];
      $vcode = $record['VendorCode'];
      return 0;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    header("Location: error.php?err=" . $e->getMessage());
    exit();
  }
}

/* UPDATE PRODUCT
 * upd_product(): updates a product
 * returns 0 if product successfully updated
 *         -1 if product does not exist
 *         1062 if product with new code already exists
 *          1452 if entered vendor does not exist
 *         error code if other db/sql error
 */
function upd_product($pcode, $descript, $date, $qoh, $min, $price, $discount, $vcode, $old_pcode, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE Product
            SET ProductCode = :pcode,
                Description = :descript,
                Indate = :date,
                QuantityOnHand = :qoh,
                MinQuantityOnHand = :min,
                Price = :price,
                DiscountRate = :discount,
                VendorCode = :vcode
            WHERE ProductCode = :old_pcode;";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':pcode', $pcode);
    $sth->bindParam(':descript', $descript);
    $sth->bindParam(':date', $date);
    $sth->bindParam(':qoh', $qoh);
    $sth->bindParam(':min', $min);
    $sth->bindParam(':price', $price);
    $sth->bindParam(':discount', $discount);
    if(empty($vcode))
      $sth->bindValue(':vcode', null);
    else
      $sth->bindParam(':vcode', $vcode);
    $sth->bindParam(':old_pcode', $old_pcode);
    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // product successfully updated
    else
    {
      $error_msg = "A product with this code does not exist.";
      return -1;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1062)
      $error_msg = "A product with this code already exists.";
    else if ($e->errorInfo[1] == 1452)
      $error_msg = "A vendor with this code does not exist.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}

/* DELETE PRODUCT
 * del_product(): deletes a product from product table
 * returns 0 if product successfully deleted
 *          -1 if product does not exist
 *         error code if other db/sql error
 */
function del_product($pcode, &$error_msg)
{
  // Connect to database server
  include_once 'db_connect.php';

  try
  {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM Product
            WHERE ProductCode = :pcode;";

    $sth = $dbh->prepare($sql);
    $sth->bindParam(':pcode', $pcode);
    $sth->execute();
    $dbh = null;
    if ($sth->rowCount() > 0)
      return 0;  // product successfully deleted
    else
    {
      $error_msg = "A product with this code does not exist.";
      return -1;
    }
  }
  catch(PDOException $e)
  {
    $dbh = null;
    if ($e->errorInfo[1] == 1451)
      $error_msg = "A product with this code is linked to some database item; cannot be deleted.";
    else
    {
      header("Location: error.php?err=" . $e->getMessage());
      exit();
    }
    return $e->errorInfo[1];
  }
}

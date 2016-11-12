<?php
//
// disp_profs.inc.php
//

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return "<td style='border:1px solid black;'>" . parent::current() . "</td>";
  }
  function beginChildren() {
    echo "<tr><td style='border:1px solid black;'>
          <button name='ccode' type='submit' formaction='view_invoice.php' value='" . parent::current() .
             "' formmethod='POST'>View</button>\n";
  }
  function endChildren() {
    echo "</tr>\n";
  }
}

// Connect to database server
include_once 'db_connect.php';

try {
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT InvoiceNumber, CustomerCode, Date, Amount
          FROM Invoice ";
  if(empty($ccode))
  {
    $sql .= " WHERE CustomerCode IS NULL";
    $sth = $dbh->prepare($sql);
  }
  else if ($ccode != "_all")
  {
    $sql .= " WHERE CustomerCode = :ccode";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':ccode', $ccode);
  }
  else
  { // all
    $sth = $dbh->prepare($sql);
    $vcode = "";
  }
  $sth->execute();

  echo "<table style='border: solid 1px black;'>\n";
  echo "<tr><th></th><th>Invoice Number</th><th>Customer Code</th><th>Date</th><th>Amount</th>\n";

  // set the resulting array to associative
  $result = $sth->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($sth->fetchAll())) as $k=>$v) {
    echo $v;
  }
  echo "</table>";
  $dbh = null;
}
catch(PDOException $e) {
  $dbh = null;
  header("Location: error.php?err=" . $e->getMessage());
}

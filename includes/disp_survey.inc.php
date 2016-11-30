<?php
//
// disp_survey.inc.php
//

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }
  function current() {
    return //"<td>" .
    parent::current() . " "
    ;
  }
  function beginChildren() {
    //echo "<tr>\n";
  }
  function endChildren() {
    echo "<br/>";
  }
}

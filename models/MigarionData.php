<?php
require("../config.php"); // for get env
require("../api/data.php"); // connection class


class MigarionData extends config
{
  private static $instance = null;
  private static $fieldsArr = null;
  private static $table = null;

  public function __construct($fieldsArr, $table)
  {
    self::$fieldsArr  = $fieldsArr;
    self::$table  = $table;
  }


  public  function Create()
  {
    try {

      if (count(self::$fieldsArr) == 0 || self::$table == "") {
        echo "Fail Please Sent Models And Table";
        return;
      }

      $config = new config();
      $fields = "";
      $fieldsFk = "";

      foreach (self::$fieldsArr as $key => $row) {
        $fields .= $row['field'] . " " . $row['type'];

        if ($row['default'] !== null) {
          $fields .= " DEFAULT " . $row['default'];
        }

        if ($row['null'] === 'no') {
          $fields .= " NOT NULL";
        }

        $fields .= ",\n";


        // add foreign keys
        if ($row['fk'] !== null) {
          $fieldsFk .=  $row['fk'];
          $fieldsFk .= ",\n";
        }
      }

      // Remove the trailing comma and newline
      // $fields = rtrim($fields, ",\n");
      $fieldsFk = rtrim($fieldsFk, ",\n");
      $sql = "
        CREATE TABLE IF NOT EXISTS " . self::$table . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            deleted_at DATETIME DEFAULT NULL,
        " .  $fields . "
        " .  $fieldsFk . "
        ) ENGINE=INNODB;
        ";
      echo $sql;

      // Execute the SQL statement
      $config->getConnection()->exec($sql);
      echo "Table " . self::$table . " created successfully.\n";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  public  function DropTable()
  {
    try {
      // Execute the SQL statement
      $config = new config();
      $sql = "DROP TABLE IF EXISTS " . self::$table . ";";
      $config->getConnection()->exec($sql);
      echo "Table " . self::$table . " Drop successfully.\n";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }


  // It works but not recommended because it is not flexible enough. It is recommended to change in the database and change the model or update to create a new one. ** There may be changes in the future.
  public  function AlterTable()
  {
    try {
      if (count(self::$fieldsArr) == 0 || self::$table == "") {
        echo "Fail Please Sent Models And Table";
        return;
      }

      $config = new config();
      $stmt = $config->getConnection()->query("DESCRIBE " . self::$table . "");
      $columns = $stmt->fetchAll();
      $NewColumn = self::$fieldsArr;

      $alterations = [];
      for ($key = 0; $key < count($NewColumn); $key++) {

        // modify column
        if (isset($NewColumn[$key]) && isset($columns[$key + 4]) && $columns[$key + 4]['Field'] === $NewColumn[$key]['field']) { // + 4  คือ บวก จำนวนรายการ column เริ่มต้น
          $modifyTxt = "MODIFY COLUMN " . $NewColumn[$key]['field'] . " ";
          $modifyTxt .= $NewColumn[$key]['type'] . " ";

          if (isset($NewColumn[$key]['default']) && $NewColumn[$key]['default'] !== null) {
            $modifyTxt .= "DEFAULT " . $NewColumn[$key]['default'] . " ";
          }

          if (isset($NewColumn[$key]['null']) && $NewColumn[$key]['null'] === 'NO') {
            $modifyTxt .= "NOT NULL";
          }

          $alterations[] = $modifyTxt;
        }

        // add new column
        if (!isset($columns[$key + 4]) && isset($NewColumn[$key])) {
          $modifyTxt = "ADD " . $NewColumn[$key]['field'] . " ";
          $modifyTxt .= $NewColumn[$key]['type'] . " ";

          if (isset($NewColumn[$key]['default']) && $NewColumn[$key]['default'] !== null) {
            $modifyTxt .= "DEFAULT " . $NewColumn[$key]['default'] . " ";
          }

          if (isset($NewColumn[$key]['null']) && $NewColumn[$key]['null'] === 'NO') {
            $modifyTxt .= "NOT NULL";
          }
          $alterations[] = $modifyTxt;
        }
      }

      // print_r($alterations);
      // return;

      if (!empty($alterations)) {
        // SQL statement to alter the table
        $sql = "ALTER TABLE " . self::$table . " " . implode(", ", $alterations) . ";";
        echo $sql . "\n";
        $config->getConnection()->exec($sql);
        echo "Table " . self::$table . " altered successfully.\n";
      } else {
        echo "No alterations needed for table " . self::$table . ".\n";
      }
    } catch (PDOException $e) {
      echo "Error Exception : " . $e->getMessage();
    }
  }

  public static function GetColumn()
  {
    $config = new config();
    $stmt = $config->getConnection()->query("DESCRIBE admins");
    $columns = $stmt->fetchAll();
    return $columns;
  }
}

<?php
require("./MigarionData.php");
require("./Admin.php");
require("./LogAdmin.php");

try {
  // Zone get column
  $adminModels = ModelsAdmin();
  $modelsLogAdmin = ModelsLogAdmin();
  // End Zone get column

  // End Zone Setting Model & Table Name
  $migrationAdmin  = new MigarionData($adminModels[0], $adminModels[1]);
  $migrationLogAdmin  = new MigarionData($modelsLogAdmin[0], $modelsLogAdmin[1]);
  // End Zone Setting Model & Table Name

  // Get command line argument
  $action = $argv[1] ?? null;
  if ($action === 'create') {
    $migrationAdmin->Create();
    $migrationLogAdmin->Create();
  } elseif ($action === 'drop') {
    // $migrationLogAdmin->DropTable();
    // $migrationAdmin->DropTable();
  } elseif ($action === 'alter') {
    // It works but not recommended because it is not flexible enough. It is recommended to change in the database and change the model or update to create a new one. ** There may be changes in the future.
    // $migrationAdmin->AlterTable();
  } else {
    echo "Invalid action. Use 'create', 'drop', or 'alter'.\n";
  }

  // get for preview get detail fields
  // $column =  $migrationAdmin->GetColumn();
  // echo "<pre>";
  // print_r($column);
  // echo "</pre>";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage() . "\n";
}

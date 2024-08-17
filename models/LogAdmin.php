<?php

function ModelsLogAdmin()
{
  $adminModels = [
    [
      "field" => "id_admin",
      "type" => "int",
      "default" => null,
      "null" => "NO",
      "fk" => "CONSTRAINT fk_id_admin FOREIGN KEY (id_admin) REFERENCES admins(id) ON DELETE CASCADE ON UPDATE CASCADE"
    ],
    [
      "field" => "detail_txt",
      "type" => "longtext",
      "default" => null,
      "null" => "NO",
      "fk" => null
    ],
    [
      "field" => "crate_by",
      "type" => "varchar(100)",
      "default" => null,
      "null" => "NO",
      "fk" => null
    ],
    [
      "field" => "types",
      "type" => "varchar(50)",
      "default" => null,
      "null" => "YES",
      "fk" => null
    ]
  ];

  $adminTable = "Logadmins";

  return  [$adminModels, $adminTable];
}

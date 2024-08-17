<?php

function ModelsAdmin()
{
  $adminModels = [
    [
      "field" => "usersname",
      "type" => "varchar(100)",
      "default" => "'xx'",
      "null" => "NO",
      "fk" => null
    ],
    [
      "field" => "password",
      "type" => "longtext",
      "default" => null,
      "null" => "NO",
      "fk" => null
    ],
    [
      "field" => "email",
      "type" => "varchar(50)",
      "default" => null,
      "null" => "YES",
      "fk" => null
    ]
  ];

  $adminTable = "admins";

  return  [$adminModels, $adminTable];
}

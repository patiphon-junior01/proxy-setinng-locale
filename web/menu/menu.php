<?php
$menu = array();

$list = [
  [
    "title_main" => "Pong Framework",
    "title_main_eng" => "Pong Framework",
    "icon" => "fab fa-php",
    "module_number" => "main",
    "list_more" =>
    [
      [
        "name" => "Index Page",
        "icon" => "far fa-circle",
        "tooltip" => "Index Page",
        "link" => "/pong-framework/",
        "menu_number" => "1",
        "module_number" => "main",
      ],
    ]
  ]
];

$menu = $list;
// $number = 1;
// foreach ($menu as $data) {
//   if ($data['module_number'] == $number) {
//     echo $data['title_main'];
//     echo "<br>";
//     for ($i = 0; $i <  count($data['list_more']); $i++) {
//       $menu_list = $data['list_more'][$i];
//       if ($menu_list['module_number'] == $data['module_number']) {
//         echo $menu_list['name'];
//         echo "<br>";
//       }
//     }
//   }
// }
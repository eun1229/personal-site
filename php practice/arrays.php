<?php
  // echo "
  // <div style='font-size:12px; color:#999;'>Employee #1</div>
  // <div style='font-size:16px; font-weight:bold; margin-bottom:20px;'>Cam</div>

  // <div style='font-size:12px; color:#999;'>Employee #2</div>
  // <div style='font-size:16px; font-weight:bold; margin-bottom:20px;'>Eva</div>

  // <div style='font-size:12px; color:#999;'>Employee #3</div>
  // <div style='font-size:16px; font-weight:bold; margin-bottom:20px;'>Reno</div>
  // ";

  $employees = [
    [
      'Name' => 'Cam',
      'PhoneNumber' => '444-444-4444'
    ],
    [
      'Name' => 'Mitchell',
      'PhoneNumber' => '555-555-5555'
    ], 
    [
      'Name' => 'Reno',
      'PhoneNumber' => '333-333-3333'
    ],
    [
      'Name' => 'Eva',
      'PhoneNumber' => '222-222-2222'
    ],
    [
      'Name' => 'Grace',
      'PhoneNumber' => '111-111-1111'
    ]
  ];

  $count = 1;

  foreach($employees as $employeeInfoArray) {
    echo "
    <div style='font-size:12px; color:#999;'>Employee #".$count."</div>
    <div style='font-size:16px; font-weight:bold;'>".$employeeInfoArray['Name']."</div>
    <div style='font: size 14px; margin-bottom:20px;'>".$employeeInfoArray['PhoneNumber']."</div>
    ";
    $count++;
  }
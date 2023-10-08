<?php

  $contactFile = '.contact.dat';

  // ファイル丸ごと読み込み
  $fileContacts = file_get_contents($contactFile);

  // echo $fileContacts;

  // ファイルに書き込み（上書き）
  // file_put_contents($contactFile, 'テストです');

  // ファイルに書き込み（追記）
  // file_put_contents($contactFile, 'テストです', FILE_APPEND);

  // 配列 file ,区切る explode, foreach

  $allData = file($contactFile);

  foreach($allData as $lineData){
    $lines = explode(',', $lineData);
    echo $lines[0]. '<br>';
    echo $lines[1]. '<br>';
    echo $lines[2]. '<br>';
  }

?>

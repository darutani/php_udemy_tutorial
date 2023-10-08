<?php

  // パスワードを記録しておく場所
  echo __FILE__;
  // /Applications/MAMP/htdocs/php_test/mainte/test.php


  echo '<br>';
  // パスワード（暗号化）
  echo(password_hash('password123', PASSWORD_BCRYPT));
  // $2y$10$EHqD/01/G1n698XKrIaE0eAqRKyEfItzTBN1nOhLY6QrhNqbyHjWS

?>

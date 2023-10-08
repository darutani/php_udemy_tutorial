<?php

  session_start();

  require 'validation.php';

  header('X-FRAME-OPTIONS:DENY');

  if (!empty($_POST)){
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
  }

  function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
  }

  $pageFlag = 0;
  $errors = validation($_POST);

  if (!empty($_POST['btn_confirm']) && empty($errors)){
    $pageFlag = 1;
  }

  if (!empty($_POST['btn_submit'])){
    $pageFlag = 2;
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php if($pageFlag === 0) : ?>
      <?php
        if (!isset($_SESSION['csrfToken'])){
          $csrfToken = bin2hex(random_bytes(32));
          $_SESSION['csrfToken'] = $csrfToken;
        }
        $token = $_SESSION['csrfToken'];
      ?>


      <div class="container">
        <?php if(!empty($errors) && !empty($_POST['btn_confirm'])) :?>
          <?php echo '<ul>'; ?>
            <?php
              foreach($errors as $error){
                echo '<li>' . $error . '</li>';
            }
            ?>
          <?php echo '</ul>'; ?>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-6">
            <form method="POST" action="input.php">
              <div class="mb-3">
                <label for="your_name" class="form-label">氏名</label>
                <input type="text" class="form-control" id="your_name" value="<?php if (!empty($_POST['your_name'])){echo h($_POST['your_name']);} ?>" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" class="form-control" id="email" value="<?php if (!empty($_POST['email'])){echo h($_POST['email']);} ?>" required>
              </div>
              <div class="mb-3">
                <label for="url" class="form-label">ホームページ</label>
                <input type="text" class="form-control" id="url" value="<?php if (!empty($_POST['url'])){echo h($_POST['url']);} ?>">
              </div>
              <div class="mb-3">
                <label class="form-label" for="gender">性別</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0">
                  <label class="form-check-label" for="inlineRadio1">男性</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1">
                  <label class="form-check-label" for="inlineRadio2">女性</label>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="age">年齢</label>
                <select class="form-select" aria-label="age">
                  <option selected>選択して下さい</option>
                  <option value="1">〜19歳</option>
                  <option value="2">20〜29歳</option>
                  <option value="3">30〜39歳</option>
                  <option value="4">40〜49歳</option>
                  <option value="5">50〜59歳</option>
                  <option value="6">60歳〜</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="contact" class="form-label">お問い合わせ内容</label>
                <textarea class="form-control" id="contact" rows="3"><?php if (!empty($_POST['contact'])){echo h($_POST['contact']);} ?></textarea>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="caution" value="1" id="caution">
                <label class="form-check-label" for="caution">
                  注意事項にチェックする
                </label>
              </div>
              <input class="btn btn-info" name="btn_confirm" type="submit" value="確認する">
              <input type="hidden" name="csrf" value="<?php echo $token; ?>">
            </form>
          </div>
        </div>
      </div>

    <?php endif; ?>

    <?php if($pageFlag === 1) : ?>
      <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) :?>
        <form method="POST" action="input.php">
          氏名
          <?php echo h($_POST['your_name']); ?>
          <br>
          メールアドレス
          <?php echo h($_POST['email']); ?>
          <br>
          <input type="submit" name="back" value="戻る">
          <input type="submit" name="btn_submit" value="送信する">

          <input type="hidden" name="your_name" value="<?php echo h($_POST['your_name']); ?>">
          <input type="hidden" name="email" value="<?php echo h($_POST['email']); ?>">
          <input type="hidden" name="url" value="<?php echo h($_POST['url']); ?>">
          <input type="hidden" name="contact" value="<?php echo h($_POST['contact']); ?>">
          <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
        </form>
      <?php endif; ?>
    <?php endif; ?>

    <?php if($pageFlag === 2) : ?>
      <?php if ($_POST['csrf'] === $_SESSION['csrfToken']) :?>
        送信が完了しました

        <?php unset($_SESSION['csrfToken']); ?>
      <?php endif; ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

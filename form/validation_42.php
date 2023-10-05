<?php
  function validation($request){
    $errors = [];

    if(empty($request['your_name']) || 20 < mb_strlen($request['your_name'])){
      $errors[] = '「氏名」は必須入力です。20文字以内で入力して下さい。';
    }

    if(empty($request['email']) || !filter_var($request['email'], FILTER_VALIDATE_EMAIL)){
      $errors[] = '「メールアドレス」は必須入力です。正しい形式で入力して下さい。';
    }

    if(!empty($request['url'])){
      if(!filter_var($request['url'], FILTER_VALIDATE_URL)){
        $errors[] = '「ホームページ」は正しい形式で入力して下さい。';
      }
    }

    if(!isset($request['gender'])){
      $errors[] = '性別を選択して下さい';
    }

    if(empty($request['age']) || 6 < $request['age']){
      $errors[] = '年齢を選択して下さい';
    }

    if(empty($request['contact']) || 200 < mb_strlen($request['contact'])){
      $errors[] = '「お問い合わせ内容」は必須入力です。200文字以内で入力して下さい。';
    }

    if(empty($request['caution'])){
      $errors[] = '注意事項をご確認の上チェックしてください';
    }

    return $errors;
  }
?>

<?php 
/*
Template Name: Thanks Page
*/
get_header(); ?>

<?php

// POSTデータのサニタイズ
$yourname = isset($_POST["yourname"]) ? sanitize_text_field($_POST["yourname"]) : '';
$spell = isset($_POST["spell"]) ? sanitize_text_field($_POST["spell"]) : '';
$tel = isset($_POST["tel"]) ? sanitize_text_field($_POST["tel"]) : '';
$email = isset($_POST["email"]) ? sanitize_email($_POST["email"]) : '';
$birth_year = isset($_POST["birth-year"]) ? sanitize_text_field($_POST["birth-year"]) : '';
$birth_month = isset($_POST["birth-month"]) ? sanitize_text_field($_POST["birth-month"]) : '';
$birth_day = isset($_POST["birth-day"]) ? sanitize_text_field($_POST["birth-day"]) : '';
$sex = isset($_POST["sex"]) ? sanitize_text_field($_POST["sex"]) : '';
$date1 = isset($_POST["date1"]) ? sanitize_text_field($_POST["date1"]) : '';
$date2 = isset($_POST["date2"]) ? sanitize_text_field($_POST["date2"]) : '';
$message = isset($_POST["message"]) ? sanitize_textarea_field($_POST["message"]) : '';

// メールアドレスの検証
if (!is_email($email)) {
    $email = '';
}

// メール送信先
$to = 'radias.fukuoka@gmail.com';

// メール件名
$subject = 'お問い合わせがありました';

// メール本文（プレーンテキスト）
$body = "お問い合わせがありました。\n";
$body .= "\n";
$body .= "入力された内容は以下の通りです。\n";
$body .= "---\n";
$body .= "\n";
$body .= "お名前：";
$body .= $yourname;
$body .= "\n";
$body .= "\n";
$body .= "フリガナ：";
$body .= $spell;
$body .= "\n";
$body .= "\n";
$body .= "電話番号：";
$body .= $tel;
$body .= "\n";
$body .= "\n";
$body .= "メールアドレス：";
$body .= $email;
$body .= "\n";
$body .= "\n";
$body .= "生年月日：";
$body .= $birth_year . "年" . $birth_month . "月" . $birth_day . "日";
$body .= "\n";
$body .= "\n";
$body .= "性別：";
$body .= $sex;
$body .= "\n";
$body .= "\n";
$body .= "第一希望日：";
$body .= $date1;
$body .= "\n";
$body .= "\n";
$body .= "第二希望日：";
$body .= $date2;
$body .= "\n";
$body .= "\n";
$body .= "ご相談内容：\n";
$body .= $message; 

// ヘッダー（差出人設定） - メールインジェクション対策
$from_name = str_replace(["\r", "\n", "%0a", "%0d"], '', $yourname);
$from_email = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);

$headers = [
    'From: ' . $from_name . ' <' . $from_email . '>',
    'Reply-To: ' . $from_email,
    'Content-Type: text/plain; charset=UTF-8',
];

// メール送信
if (!empty($yourname) && !empty($email)) {
    wp_mail($to, $subject, $body, $headers);
}

?>

<main>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
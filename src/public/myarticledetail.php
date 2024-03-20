<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blogアプリ</title>
</head>
<body>

    <?php include 'header/header.php'; ?>

    <main>

        <div>
            <h1>マイ記事タイトル</h1>
        </div>

        <!-- マイ記事の詳細、表示、編集、削除、マイページへ -->
        <form action="" method=""> 
            <div>
                <p>投稿日時:  </p>
                <p>記事内容</p>
            </div>
            <button><a href="edit.php">編集</a></button>
            <button type="submit">削除</button>
            <button><a href="mypage.php">マイページへ</a></button>
        </form>

    </main>
  
</body>
</html>
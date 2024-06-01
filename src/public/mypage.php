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
            <h1>マイページ</h1>
        </div>

        <!-- 新規作成ボタン -->
        <div>
            <p><a href="create.php">新規作成</a></p>
        </div>

        <!-- マイ記事一覧 -->
        <div>

            <h2>タイトル</h2>
            <p>作成日時</p>
            <p>contents</p>
            <p><a href="myarticledetail.php">マイ該当詳細記事へ</a></p>
            <div>--------------------------------------------------</div>

        </div>


    </main>
  
</body>
</html>
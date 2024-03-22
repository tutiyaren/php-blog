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

        <!-- 記事新規作成欄 -->
        <div>
            <div>
                <h2>新規記事</h2>
            </div>
            <form action="" method="post">
                <!-- 記事タイトル -->
                <div>
                    <label for="title">タイトル</label>
                    <input type="text" name="title" id="title">
                </div>
                <!-- 記事内容 -->
                <div>
                    <label for="contents">内容</label>
                    <textarea name="contents" id="contents" cols="30" rows="10"></textarea>
                </div>
                <!-- 記事作成ボタン -->
                <div>
                    <button type="submit">新規作成</button>
                </div>
            </form>
        </div>

    </main>
  
</body>
</html>
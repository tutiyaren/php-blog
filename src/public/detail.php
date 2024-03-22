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
        <!-- 対象記事 -->
        <div>
            <div>
                <h1>タイトル</h1>
            </div>
            <div>
                <div>
                    <p>作成日時:  </p>
                    <p>contents</p>
                </div>
                <div>
                    <a href="index.php">一覧ページへ</a>
                </div>
            </div>
        </div>

        <!-- コメント入力欄 -->
        <div>
            <div>
                <h2>この投稿にコメントしますか？</h2>
            </div>
            <form action="" method="post">
                <!-- コメントタイトル -->
                <div>
                    <label for="commenter_name">コメント名</label>
                    <input type="text" name="commenter_name" id="commenter_name">
                </div>
                <!-- コメント内容 -->
                <div>
                    <label for="comments">内容</label>
                    <textarea name="comments" id="comments" cols="30" rows="10"></textarea>
                </div>
                <!-- コメントボタン -->
                <div>
                    <button type="submit">コメント</button>
                </div>
            </form>
        </div>

        <!-- コメント一覧 -->
        <div>
            <div>
                <h3>コメント一覧</h3>
            </div>
            <div>

                <h4>コメントタイトル</h4>
                <p>投稿作成日時</p>
                <p>コメント内容</p>
                <div>---------------------------------------------</div>

            </div>
        </div>

    </main>
  
</body>
</html>
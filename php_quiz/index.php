<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();

if (!$quiz->isFinished()) {
      $data = $quiz->getCurrentQuiz();
      shuffle($data['a']);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>英単語テスト！</h1>
  </header>
  <!--問題が終了の場合終了画面を表示-->
  <?php if ($quiz->isFinished()) : ?>
    <div id="container">
      <div id="result">
        正解率は
        <div><?= h($quiz->getScore()); ?> %</div>
      </div>
      <a href=""><div id="btn">Replay?</？></a>
    </div>
        <?php $quiz->reset(); ?>
  <?php else : ?>
    <div id="container">
      <h1>Q. <?= h($data['q']); ?></h1>
      <ul>
        <?php foreach ($data['a'] as $a) : ?>
          <li class="answer"><?= h($a); ?></li>
        <?php endforeach; ?>
      </ul>
      <div class="kaisetsu">
        <h2>よくわかる解説</h2>
        <div id="text-button"><p id="text"></p></div>
        <!-- <input type="button" value="解説を表示"> -->
        <!-- <button type="button" id="form-button">入力</button> -->
        <!-- <div id="form-text"></div> -->
        <!-- <a class="btn-kai" name=kai><a href="#">解説を表示</a></a> -->
        <!-- ?php if(isset($_POST['kai'])) : ?> -->
        <!-- ?= h($data['k']); ?> -->
        <!-- <p id="ans-20170519-1"></p> -->
        <!-- <p>mumuu</p> -->
        <!-- ?php endif; ?> -->
        <!-- <div id="form-text"></div>     -->

      </div>
      <div id="btn" class="disabled"><?= $quiz->isLast() ? 'Show Result' : 'Next Question'; ?></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!--ライブラリここのVerをミスすると動かない-->
    <script src="quiz.js"></script>
    <!-- <sc type="text/javascript" src="quiz.js"></sc> -->
  <?php endif; ?>
</body>

</html>
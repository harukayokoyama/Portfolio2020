<?php

namespace MyApp;

class Quiz
{
    private $_quizSet = [];

    public function __construct()
    {
        $this->setUp();

        if (!isset($_SESSION['current_num'])) {
            $_SESSION['current_num'] = 0;
            $_SESSION['correct_count'] = 0;
        }
    }

    public function checkAnswer()
    {
        $correctAnswer = $this->_quizSet[$_SESSION['current_num']]['a'][0]; //aの0番目が正
        //正解数表示用
        if ($correctAnswer === $_POST['answer']) {
            $_SESSION['correct_count']++;
        }
        //問題数を1増やす
        $_SESSION['current_num']++;
        return $correctAnswer;
    }

    
    public function isFinished()
    {
        return count($this->_quizSet) === $_SESSION['current_num'];
    }

    //正解数
    public function getScore()
    {
        return round($_SESSION['correct_count'] / count($this->_quizSet) * 100);
    }

    //最後の問題になったらボタンを変えるため
    public function isLast()
    {
        return count($this->_quizSet) === $_SESSION['current_num'] + 1;
    }

    //$current_num,correct_countをリセットする
    public function reset()
    {
        $_SESSION['current_num'] = 0;
        $_SESSION['correct_count'] = 0;
    }

    public function getCurrentQuiz()
    {
        return $this->_quizSet[$_SESSION['current_num']];
    }

    private function setUp()
    {
        $this->_quizSet[] = [
            'q' => 'adaptの意味は?', //問題
            'a' => ['適合させる', '採用する', '逃げる', '逮捕する'], //答え
            'k' => 'ここの部分には解説が入る' //解説
        ];
        $this->_quizSet[] = [
            'q' => '砂漠を英語で書くと?',
            'a' => ['desert', 'dessert', 'sand', 'sabaku'],
            'k' => 'ここの部分には解説が入る'
        ];
        $this->_quizSet[] = [
            'q' => 'lendの意味は?',
            'a' => ['貸す', '借りる', '遊園地', '土地'],
            'k' => 'ここの部分には解説が入る'
        ];
    }

}
$(function () {
    'use strict';

    //liをクリックするイベント
    $('.answer').on('click', function () {
        //クリックされた要素のテキストを引っ張る
        var $selected = $(this);
        //一つ押したらほかのボタンを押せないようにする(処理中普段)
        if ($selected.hasClass('correct') || $selected.hasClass('wrong')) {
            return;
        }
        $selected.addClass('selected');

        //保持
        var answer = $selected.text();
        
        //Ajax処理
        $.post('./_answer.php', {
            answer: answer//checkAnswer(正解数表示部分)のため

        }).done(function (res) {
            $('.answer').each(function() {
                //正解時と誤答時でスタイル適用
                if ($(this).text() === res.correct_answer) {
                    $(this).addClass('correct');
                } else {
                    $(this).addClass('wrong');
                }
            });
            if (answer === res.correct_answer) {
                //正解処理:〇〇..CORRECT!と表示
                $selected.text(answer + '  〇');
            } else {
                //誤答処理 
                $selected.text(answer + '  X');
            }
            //disabled(半透明)のクラスを消去＝押せるようになる
            $('#btn').removeClass('disabled');

            document.getElementById("text").innerHTML = "解説が入る";
        });
    });

    //ボタンをクリックしdisabledクラスがなければページをリロード
    $('#btn').on('click', function () {
        if (!$(this).hasClass('disabled')) {
            location.reload();
        }
    });

    //解説を押すと解説を表示する
   

});
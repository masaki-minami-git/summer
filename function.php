<?php


function isValid($s)
{
    // ファンクションの引数として入力された文字列を配列$strArrayに格納
    $strArray = str_split($s);
    //$strArrayの最後の添字を取得
    $lastStrKey = array_key_last($strArray);

    /**
     * 括弧のペア同士を配列に格納し定義する
     */
    /**
     * 小括弧()
     */
    $bracket = [];
    $bracket[] = "(";
    $bracket[] = ")";
    /**
     * 中括弧[]
     */
    $square = [];
    $square[] = "[";
    $square[] = "]";
    /**
     * 大括弧{}
     */
    $brace = [];
    $brace[] = "{";
    $brace[] = "}";

    //空のテンポラリー配列を作成
    $tempo = [];

    //ファンクションに入力された文字列を一つずつ取り出し、
    foreach ($strArray as $key => $value) {
        //開き括弧が来たならテンポラリー配列へ格納
        if ($value == $bracket[0] || $value == $square[0] || $value == $brace[0]) {
            array_push($tempo, $value);
        } else {
            //閉じ括弧が来た場合
            //テンポラリー配列の最後の添字を取得
            $lastKey = array_key_last($tempo);
            //テンポラリー配列の中身がなければ、閉じ括弧から始まってることになるので false 出力
            if (empty($tempo)) {
                return false;
            } else {
                // 中身がある場合、どの開き括弧かを判定
                if ($tempo[$lastKey] == $bracket[0]) {
                    // テンポラリー配列の最後の要素とループで来た閉じ括弧を比較
                    // 違う場合はペアが不一致のため false　出力
                    if ($value != $bracket[1]) {
                        return false;
                    }
                } elseif ($tempo[$lastKey] == $square[0]) {
                    if ($value != $square[1]) {
                        return false;
                        exit;
                    }
                } else {
                    if ($value != $brace[1]) {
                        return false;
                    }
                }
                //テンポラリー配列の最後の要素を削除
                array_pop($tempo);
            }
        }
        //最後まで$strArrayが回った時
        if ($key == $lastStrKey) {
            // テンポラリー配列の中身があれば閉じきれていないため false を出力
            if (!empty($tempo)) {
                return false;
            } else {
                // 配列がなくなった場合成功。
                return true;
            }
        }
    }
}

$s = '{()}';
var_dump(isValid($s)); // true

$s = '({)}';
var_dump(isValid($s)); // false

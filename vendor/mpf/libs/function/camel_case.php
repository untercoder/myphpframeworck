<?php

// Метод который переводит название контроллера в CamelCase
function camelCase($word): string {
    $word = str_replace("-", " ", $word);
    $word = ucwords($word); // делает все слова с большой буквы
    $word = str_replace(" ", "", $word);
    return $word;
}

function lowerCamelCase($word): string {
    return lcfirst(camelCase($word));
}

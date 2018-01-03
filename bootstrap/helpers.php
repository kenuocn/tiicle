<?php

function route_class() {
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 提取字符
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value, $length = 200) {
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

/**
 * 去除vue双花括号冲突
 * @param $body
 * @return mixed
 */
function remove_vue($body = null)
{
    $body = str_replace("{{","",$body);
    $body = str_replace("}}","",$body);

    return $body;
}


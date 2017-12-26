<?php

namespace App\Http\Controllers\Home\Traits;

trait Markdown {

    /**
     * 处理格式
     * @param $markdown
     * @return mixed
     */
    public function convertMarkdownToHtml($markdown)
    {
        $convertedHmtl = app('Parsedown')->setBreaksEnabled(true)->text($markdown);
        $convertedHmtl = str_replace("<pre><code>", '<pre><code class=" language-php">', $convertedHmtl);
        $convertedHmtl = remove_vue($convertedHmtl);

        return $convertedHmtl;
    }

}

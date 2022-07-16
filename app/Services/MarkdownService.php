<?php

namespace App\Services;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\DisallowedRawHTML\DisallowedRawHTMLExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class MarkdownService
{
    public static function parse($text)
    {
        $environment = Environment::createGFMEnvironment();

        $environment->addExtension(new TableExtension);
        $environment->addExtension(new DisallowedRawHTMLExtension());

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ], $environment);

        return new HtmlString($converter->convert($text));
    }
}

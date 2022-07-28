<?php

namespace App\Services;

use Jfcherng\Diff\DiffHelper;

class DifferService
{
    public static function getDiffText(string $contentOld, string $contentNew): string
    {
        $rendererName = 'Unified';

        $header = self::getHeader(hash('md5', $contentOld), hash('md5', $contentNew));
        $body = DiffHelper::calculate($contentOld, $contentNew, $rendererName);

        return $header . $body;
    }

    public static function getHeader(string $oldHash, string $newHash): string
    {
        return "diff --git a/{$oldHash} b/{$newHash}\n";
    }
}

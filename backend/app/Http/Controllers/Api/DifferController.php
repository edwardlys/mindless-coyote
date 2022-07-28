<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Services\DifferService;
use Illuminate\Http\Request;

class DifferController extends Controller
{
    const RESPONSE_CODE_DIFF_GEN = 'DIFF_GEN';
    const RESPONSE_CODE_DIFF_NONE = 'DIFF_NONE';

    public function generateDiff(Request $request)
    {
        $oldContent = $request->input('oldContent') ?? '';
        $newContent = $request->input('newContent') ?? '';

        $diffText = DifferService::getDiffText($oldContent, $newContent);

        if (!empty($diffText)) {
            return $this->respondWith(
                [
                    'diffText' => $diffText,
                ], 
                self::RESPONSE_CODE_DIFF_GEN,
                'Text difference generated.'
            );
        }
        
        return $this->respondWith([], self::RESPONSE_CODE_DIFF_NONE, 'There was no difference in text');
    }
}

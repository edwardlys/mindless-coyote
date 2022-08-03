<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Eloquent\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EntriesController extends Controller
{
    const RESPONSE_CODE_ENTRY_RETRIEVED = 'ENTRY_RETRIEVED';
    const RESPONSE_CODE_ENTRY_SAVED = 'ENTRY_SAVED';
    const RESPONSE_CODE_ENTRY_UPDATED = 'ENTRY_UPDATED';
    const RESPONSE_CODE_ENTRY_DELETED = 'ENTRY_DELETED';
    const RESPONSE_CODE_ENTRY_NOT_EXIST = 'ENTRY_NOT_EXIST';

    public function index()
    {
        $entries = Entry::where('published', true)->get();
        
        return $this->respondWith(
            [
                'entries' => $entries,
            ], 
            self::RESPONSE_CODE_ENTRY_RETRIEVED, 
        );
    }

    public function view(string $slug)
    {
        $entry = Entry::where('slug', $slug)
            ->orderByDesc('created_at')
            ->first();

        return $this->respondWith(
            [
                'entry' => $entry,
            ], 
            self::RESPONSE_CODE_ENTRY_RETRIEVED, 
        );
    }

    public function create(Request $request)
    {
        $params = $request->only('title', 'content');

        $entry = Entry::create([
            'title' => $params['title'],
            'content' => $params['content'],
            'slug' => Str::slug($params['title']),
            'published' => true,
        ]);

        return $this->respondWith(
            [
                'entry' => $entry,
            ], 
            self::RESPONSE_CODE_ENTRY_SAVED, 
        );
    }

    public function update(Request $request, string $slug)
    {
        $params = $request->only('title', 'content');

        $oldEntry = Entry::where('slug', $slug)
            ->orderByDesc('created_at')
            ->first();
        
        if (empty($oldEntry)) {
            return $this->respondWith(
                [],
                self::RESPONSE_CODE_ENTRY_NOT_EXIST,
                'The entry requested does not exist in the system.'
            );
        }

        Entry::where('slug', $slug)->update(['published' => false]);

        $newEntry = Entry::create([
            'title' => $params['title'],
            'content' => $params['content'],
            'slug' => $slug,
            'published' => true,
        ]);

        return $this->respondWith(
            [
                'entry' => $newEntry,
            ], 
            self::RESPONSE_CODE_ENTRY_UPDATED, 
        );
    }

    public function delete(string $slug)
    {
        Entry::where('slug', $slug)->delete();

        return $this->respondWith(
            [], 
            self::RESPONSE_CODE_ENTRY_DELETED, 
        );
    }
}

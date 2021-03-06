<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Debug\Debug;

class CompendiumItem extends Model
{

    static $redirect = '';

    public static function storeCompendiumItem($item, $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50'
        ]);
        $item->url = Str::slug($validated['name'], '_');
        $item->name = $validated['name'];
        $item->campaign_id = $request->post('campaign_id');
        $item->save();
        $item->refresh();

        return $item;
    }

    public static function updateCompendiumItem($request, $item)
    {
        $post = $request->post();
        if (isset($post['body'])) {
            $item->body = $request->validate([
                'body' => 'max:65535'
            ])['body'];
            if (isset($post['dm_notes'])) {
                $item->dm_notes = $request->validate([
                    'dm_notes' => 'max:65535'
                ])['dm_notes'];
            }
        }
        if (isset($post['name'])) {
            $valid = $request->validate([
                'name' => 'max:50'
            ]);
            $valid['name'] = trim($valid['name']);
            $item->name = $valid['name'];
            $url = Str::slug($valid['name'], '_');
            if ($url !== $item->url) {
                $http = explode('/', $_SERVER['HTTP_REFERER']);
                array_splice($http, -1, 1, $url);
                self::$redirect = implode('/', $http);
                $item->url = $url;
            }
        }
        $item->save();
        $item->refresh();

        return $item;
    }

    public static function showComponent($item, $itemType, $isDm)
    {
        $lastUpdated = $item->updated_at;
        $onMap = Str::contains($_SERVER['HTTP_REFERER'], 'maps');
        return view('components.compendium-item', compact('item', 'itemType', 'isDm', 'lastUpdated', 'onMap'))->render();
    }
}
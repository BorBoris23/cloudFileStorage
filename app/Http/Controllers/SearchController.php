<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SearchController
{
    public function search(Request $request)
    {
        $collection = [];
        $contents = Storage::disk('s3')->allFiles();
        foreach ($contents as $link) {
            if (str_contains($link, $request->searchText)) {
                $collection[] = $this->composeResponse(explode('/', str_replace(Session::get('rootDirectory') . '/', '', $link)), $request->searchText);
            }
        }
        return collect(call_user_func_array('array_merge', $collection))->unique()->values()->all();
    }

    private function composeResponse($searchResult, $searchText)
    {
        $response = [];
        while (count($searchResult) > 0) {
            $name = array_pop($searchResult);
            if(str_contains($name, $searchText)) {
                $response[] = new Response($name, implode('/', $searchResult));
            }
        }
        return $response;
    }
}

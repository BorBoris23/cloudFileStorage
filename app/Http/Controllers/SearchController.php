<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SearchController
{
    public function search()
    {
        $collection = [];
        $content = $this->getContentCurrentUser(Storage::disk('s3')->allFiles(), Session::get('rootDirectory'));
        foreach ($content as $link) {
            if (str_contains($link, $_GET['query'])) {
                $collection[] = $this->composeResponse(explode('/', str_replace(Session::get('rootDirectory') . '/', '', $link)), $_GET['query']);
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

    private function getContentCurrentUser($content, $rootDirectory)
    {
        foreach ($content as $key => $value) {
            if(!str_contains($value, $rootDirectory)) {
                unset($content[$key]);
            }
        }
        return array_merge($content);
    }
}

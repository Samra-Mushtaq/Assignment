<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TranslationResource;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $translations =  TranslationResource::collection(LanguageLine::paginate(10));
        return $translations;
    }

    public function store(Request $request)
    {
        
    }

    public function show(Request $request, $id)
    {
        $translations = new TranslationResource(LanguageLine::findOrFail($id));
        return $translations;
    }

    public function update(Request $request, $id)
    {
       
    }

    public function destroy($id)
    {
        
    }
}

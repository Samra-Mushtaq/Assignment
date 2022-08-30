<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Translation;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:translation-list|translation-create|translation-edit|translation-delete', ['only' => ['index','show']]);
        $this->middleware('permission:translation-create', ['only' => ['create','store']]);
        $this->middleware('permission:translation-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:translation-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $translations = LanguageLine::all();
        return view('backend.translations.index',compact( 'translations'));

    }

    public function create()
    {
        $translations = LanguageLine::all();
        return $translations;
    }

    public function store(Request $request)
    {
        $data = [
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        $key = $request->title_en . ' '. $request->title_ar;
        LanguageLine::create([
            'group' => 'translation',
            'key' => $key,
            'text' => $data,
        ]);
        // trans('translation.key'); // 
        // app()->setLocale('textkey');
        // trans('validation.required'); // 
        return 1;
    }

    
    public function show(Request $request, $id)
    {
        $translation = LanguageLine::where('id', $id)->first();
        $key = $request->title_en . ' '. $request->title_ar;
        $data = [
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        $translation->key = $key;
        $translation->text = $data;
        $res = $translation->save();
    }

    public function edit($id)
    {
        $translations = LanguageLine::where('id', $id)->first();
        return $translations;
    }

    public function update(Request $request, $id)
    {
        //
        $translation = LanguageLine::where('id', $id)->first();
        $key = $request->title_en . ' '. $request->title_ar;
        $data = [
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        $translation->key = $key;
        $translation->text = $data;
        $res = $translation->save();
        return 1;
    }

    public function destroy($id)
    {
        $translations = LanguageLine::where('id', $id)->delete();
        return "Deleted";
    }
}

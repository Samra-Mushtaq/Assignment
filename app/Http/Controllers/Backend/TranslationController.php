<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Translation;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // LanguageLine::create([
        //     'group' => 'validation',
        //     'key' => 'required',
        //     'text' => ['en' => 'This is a required field', 'ar' => 'Dit is een verplicht veld'],
        //  ]);
        $translations = LanguageLine::all();
        return view('backend.translations.index',compact( 'translations'));


        //  dd($language[0]->text["en"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        // trans('translation.key'); // returns 

        // app()->setLocale('textkey');

        // trans('validation.required'); // 
        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $translations = LanguageLine::where('id', $id)->first();
        return $translations;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Translation  $translation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $translations = LanguageLine::where('id', $id)->delete();
        return $translations;
    }
}

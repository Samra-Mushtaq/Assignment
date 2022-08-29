<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TranslationResource;
use App\Http\Controllers\Controller;
use Spatie\TranslationLoader\LanguageLine;

use Illuminate\Http\Request;

class TranslationController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:translation-list|translation-create|translation-edit|translation-delete', ['only' => ['index','show']]);
         $this->middleware('permission:translation-create', ['only' => ['create','store']]);
         $this->middleware('permission:translation-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:translation-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $translations =  TranslationResource::collection(LanguageLine::all());
        return $translations;
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
        return "Added";
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
        $translations = new TranslationResource(LanguageLine::findOrFail($id));
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
        return "Updated";
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
        return "Deleted";
    }
}

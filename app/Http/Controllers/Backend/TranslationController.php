<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Translation;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;
use App\Http\Requests\NotificationRequest;

use DataTables;

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
        return view('backend.translations.index');

    }
    public function dataTable () {
        $translations = LanguageLine::all();
        return Datatables::of($translations)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                $actions = '';
                if(auth()->user()->hasPermissionTo('translation-edit')) {
                    $actions .= '<button class="btn btn-primary  mr-1 p-1" data-act="ajax-modal" data-method="get"
                            data-action-url="'. route('translations.edit', $record->id). '" data-title="Edit Translation"
                            data-toggle="tooltip" data-placement="top" title="Edit Translation">
                                Edit
                            </button>';
                }
                if(auth()->user()->hasPermissionTo('translation-delete')) {
                    $actions .= '<a class="btn btn-danger delete p-1" data-table="translations-table" data-method="get"
                            data-url="' .route('translations.destroy', $record->id). '" data-toggle="tooltip" data-placement="top" title="Delete Translation">
                                Delete
                            </a>';
                }
                return $actions;
            })
            ->addColumn('title_en', function ($record) {
                $data = $record->text['title_en'];
                return $data;
            })
            ->addColumn('title_ar', function ($record) {
                $data = $record->text['title_ar'];
                return $data;
            })
            ->addColumn('description_en', function ($record) {
                $data = $record->text['description_en'];
                return $data;
            })
            ->addColumn('description_ar', function ($record) {
                $data = $record->text['description_ar'];
                return $data;
            })
            ->rawColumns(['actions', 'title_en', 'title_ar', 'description_en', 'description_ar'])->make(true);
    }

    
    public function create()
    {
        return view('backend.translations.model');

    }

    public function store(NotificationRequest $request)
    {
        try{
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
            return response()->json([
                'message' => 'Translation Successfully Added'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
    }

    
    public function show(Request $request, $id)
    {
        
    }

    public function edit($id)
    {
        $translation = LanguageLine::where('id', $id)->first();
        return view('backend.translations.model', compact('translation'));
    }

    public function update(NotificationRequest $request, $id)
    {
        //
        try{
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
            return response()->json([
                'message' => 'Translation Successfully Updated'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
    }

    public function destroy($id)
    {
        try{
            $translations = LanguageLine::where('id', $id)->delete();
            return response()->json([
                'message' => 'Translation Successfully Deleted'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
    }
}

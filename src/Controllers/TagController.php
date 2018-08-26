<?php

namespace ArtinCMS\LTS\Controllers;

use ArtinCMS\LTS\Models\Tag;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;

class TagController extends Controller
{
    public function manageTag()
    {
        $multiLangFunc = config('laravel_tagable.multiLang');
        if ($multiLangFunc)
        {
            $multiLang = json_encode($multiLangFunc());
        }
        else
        {
            $multiLang = false;
        }
        return view('laravel_tagable::backend.index',compact('multiLang'));
    }

    public function getTag(Request $request)
    {
        $Tag = Tag::with('user');

        return DataTables::eloquent($Tag)
            ->editColumn('id', function ($data) {
                return LTS_getEncodeId($data->id);
            })
            ->editColumn('description', function ($data) {
                return strip_tags($data->description);
            })
            ->make(true);
    }

    public function saveTag(Request $request)
    {
        $Tag = new Tag;
        $Tag->title = $request->title;
        $Tag->description = $request->description;
        if (Auth::user())
        {
            if (isset(Auth::user()->id))
            {
                $Tag->created_by = Auth::user()->id;
            }
        }
        if ($request->lang_id)
        {
            $lang_id = $request->lang_id;
            $multiLang = config('laravel_tagable.multiLang')();
            $Tag->lang_id = $lang_id;
            $lang_title = $this->searchForId($lang_id, $multiLang);
            $Tag->lang_name = $lang_title;
        }
        $Tag->save();
        $res =
            [
                'success' => true,
                'title'   => "ثبت تگ جدید",
                'message' => 'تگ با موفقیت ثبت شد.'
            ];
        return $res;
    }

    public function getEditTagForm(Request $request)
    {
        $multiLangFunc = config('laravel_tagable.multiLang');
        if ($multiLangFunc)
        {
            $multiLang = json_encode($multiLangFunc());
        }
        else
        {
            $multiLang = false;
        }
        $tag = Tag::find(LTS_GetDecodeId($request->item_id));
        $tag->encode_id = LTS_getEncodeId($tag->id);
        $Tag_form = view('laravel_tagable::backend.view.edit', compact('tag','multiLang'))->render();
        $res =
            [
                'success'       => true,
                'Tag_edit_view' => $Tag_form
            ];
        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function editTag(Request $request)
    {
        $Tag = Tag::find(LTS_GetDecodeId($request->item_id));
        $Tag->title = $request->title;
        $Tag->description = $request->description;
        if (Auth::user())
        {
            if (isset(Auth::user()->id))
            {
                $Tag->created_by = Auth::user()->id;
            }
        }
        if ($request->lang_id)
        {
            $lang_id = $request->lang_id;
            $multiLang = config('laravel_tagable.multiLang')();
            $Tag->lang_id = $lang_id;
            $lang_title = $this->searchForId($lang_id, $multiLang);
            $Tag->lang_name = $lang_title;
        }
        $Tag->save();
        $res =
            [
                'success' => true,
                'title'   => "ویرایش تگ",
                'message' => 'تگ با موفقیت ویرایش شد.'
            ];

        return $res;
    }

    public function trashTag(Request $request)
    {
        $Tag = Tag::find(LTS_GetDecodeId($request->item_id));
        $Tag->delete();

        $res =
            [
                'success' => true,
                'title'   => "حذف تگ",
                'message' => 'تگ با موفقیت حذف شد.'
            ];

        throw new HttpResponseException(
            response()
                ->json($res, 200)
                ->withHeaders(['Content-Type' => 'text/plain', 'charset' => 'utf-8'])
        );
    }

    public function setTagStatus(Request $request)
    {
        $Tag = Tag::find(LTS_GetDecodeId($request->item_id));
        if ($request->is_active == "true")
        {
            $Tag->is_active = "1";
            $res['message'] = ' تگ فعال گردید';
        }
        else
        {
            $Tag->is_active = "0";
            $res['message'] = 'تگ غیر فعال شد';
        }
        $Tag->save();
        $res['success'] = true;
        $res['title'] = 'وضعیت تگ تغییر پیدا کرد .';

        return $res;
    }

    public function autoCompleteTag(Request $request)
    {
        $x = $request->term;
        $data = Tag::select("id", 'title AS text')->where('is_active', '1');
        if ($x['term'] != '...')
        {
            $data = Tag::select("id", 'title AS text')
                ->where('is_active', '1')
                ->where("title", "LIKE", "%" . $x['term'] . "%");
        }
        $data = $data->get();
        $data = ['results' => $data];
        return response()->json($data);
    }

    function searchForId($id, $array)
    {
        foreach ($array as $value)
        {
            if ($value['id'] == $id)
            {
                return $value['text'];
            }
        }

        return null;
    }
}

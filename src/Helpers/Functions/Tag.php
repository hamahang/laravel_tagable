<?php
if (!function_exists('LTS_saveTag'))
{
    function LTS_saveTag($obj_model, $arr_ids, $type = 'tag', $relation_name = 'tags', $attach_type = 'attach')
    {
        if ($attach_type != 'attach')
        {
            $attach_type = 'sync';
        }
        if ($arr_ids)
        {
            foreach ($arr_ids as $key => $value)
            {
                $id[ $value ] = ['type' => $type];
            }
            $obj_model->$relation_name()->wherePivot('type', '=', $type)->$attach_type($id);
            $result['success'] = true;
        }
        else
        {
            $result['success'] = false;
        }

        return $result;
    }
}
if (!function_exists('LTS_showTag'))
{
    function LTS_showTag($obj_model, $type = 'tag', $relation_name = 'tags')
    {
        $tags = $obj_model->$relation_name()->where('type', '=', $type)->get();

        return $tags;
    }
}
//------------sample language function------------------------------//
function faq_sampleLang()
{
    $lang = [
        [
            'id'   => 1,
            'text' => 'Persian'
        ],
        [
            'id'   => 2,
            'text' => 'English'
        ],
        [
            'id'   => 3,
            'text' => 'Spanish'
        ],
        [
            'id'   => 4,
            'text' => 'Italian'
        ], [
            'id'   => 5,
            'text' => 'French'
        ],
        [
            'id'   => 6,
            'text' => 'Russian'
        ],
        [
            'id'   => 7,
            'text' => 'Arabic'
        ]
    ];

    return $lang;
}

function LTS_getEncodeId($id)
{
    if ($id < 0)
    {
        return $id;
    }
    else
    {
        $hashids = new \Hashids\Hashids(md5('sadeghi'));

        return $hashids->encode($id);
    }

}

function LTS_GetDecodeId($id, $route = false)
{
    $my_routes = [
        'LFM.DownloadFile',
        'LFM.ShowCategories',
        'LFM.ShowCategories.Create',
        'LFM.ShowCategories.Edit',
        'LFM.EditFile',
        'LFM.FileUpload',
        'LFM.FileUploadForm',
        'LFM.EditPicture',
        'LFM.Breadcrumbs',
    ];
    if ((int)$id < 0)
    {
        return (int)$id;
    }
    else
    {
        $hashids = new \Hashids\Hashids(md5('sadeghi'));
        if ($route)
        {
            if (in_array($route->getName(), $my_routes))
            {
                if ($hashids->decode($id) != [])
                {
                    return $hashids->decode($id)[0];
                }
                else
                {
                    return $id;
                }
            }
            else
            {
                return $id;
            }
        }
        else
        {
            return $hashids->decode($id)[0];
        }
    }

}
?>
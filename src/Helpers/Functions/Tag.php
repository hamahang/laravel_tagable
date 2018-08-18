<?php
if (!function_exists('LTS_saveTag'))
{
    function LTS_saveTag($obj_model,$arr_ids,$type='tag',$relation_name = 'tags', $attach_type = 'attach')
    {
        if ($attach_type != 'attach')
        {
            $attach_type = 'sync';
        }
        if ($arr_ids)
        {
            foreach ($arr_ids as  $key=>$value)
            {
                $id[$value]=['type' => $type];
            }
            $obj_model->$relation_name()->wherePivot('type', '=', $type)->$attach_type($id);
            $result['success'] = true;
        }
        else
        {
            $result['success'] = false;
        }
        return $result ;
    }
}
if (!function_exists('LTS_showTag'))
{
    function LTS_showTag($obj_model, $type = 'tag', $relation_name = 'tags')
    {
        $tags = $obj_model->$relation_name()->where('type', '=', $type)->get();
        return $tags ;
    }
}

?>
<?php
function createFormItem($type, $data) {
    $result="";
    switch ($type) {
        case "input":
            $result='
                <div class="mb-1" style="'.$data['style'].'">
                    <label class="form-label" for="'.$data['name'].'">'.$data['name_visual'].'</label>
                    <input '.$data['attr'].' type="'.$data['input_type'].'" name="'.$data['name'].'" class="form-control" placeholder="'.$data['placeholder'].'" value="'.$data['value'].'">
                    ';

            if($data['label']!="")
                $result.='
                    <p><small class="text-muted">'.$data['label'].'</small></p>
            ';

            $result.='
                </div>
            ';
            break;
        case "input_twice":
            $result='
                <div class="row" style="'.$data['style'].'">
                    <div class="col-xl-6 col-md-6 col-12">
                        <label class="form-label" for="'.$data['name1'].'">'.$data['name_visual1'].'</label>
                        <input '.$data['attr1'].' type="'.$data['input_type1'].'" name="'.$data['name1'].'" class="form-control" placeholder="'.$data['placeholder1'].'" value="'.$data['value1'].'">
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <label class="form-label" for="'.$data['name2'].'">'.$data['name_visual2'].'</label>
                        <input '.$data['attr2'].' type="'.$data['input_type2'].'" name="'.$data['name2'].'" class="form-control" placeholder="'.$data['placeholder2'].'" value="'.$data['value2'].'">
                    </div>
                </div>
            ';
            break;
        case "input2":
            $result='
                <div class="mb-1" style="'.$data['style'].'">
                    <label class="form-label" for="'.$data['name'].'">'.$data['name_visual'].'</label>
                    <div class="input-group form-password-toggle mb-2">
                        <input '.$data['attr'].' type="'.$data['input_type'].'" name="'.$data['name'].'" class="form-control" placeholder="'.$data['placeholder'].'" value="'.$data['value'].'">
                        <span class="input-group-text">'.$data['value_type'].'</span>
                    </div>
            ';

            if($data['label']!="")
                $result.='
                    <p><small class="text-muted">'.$data['label'].'</small></p>
            ';

            $result.='
                </div>
            ';
            break;
        case "input2_twice":
            $result='
                <div class="row" style="'.$data['style'].'">
                    <div class="col-xl-6 col-md-6 col-12">
                        <label class="form-label" for="'.$data['name1'].'">'.$data['name_visual1'].'</label>
                        <div class="input-group form-password-toggle mb-2">
                            <input '.$data['attr1'].' name="'.$data['name1'].'" type="'.$data['input_type1'].'" class="form-control" placeholder="'.$data['placeholder1'].'" value="'.$data['value1'].'" aria-describedby="basic-default-password">
                            <span class="input-group-text">'.$data['value_type2'].'</span>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <label class="form-label" for="'.$data['name2'].'">'.$data['name_visual2'].'</label>
                        <div class="input-group form-password-toggle mb-2">
                            <input '.$data['attr2'].' name="'.$data['name2'].'" type="'.$data['input_type2'].'" class="form-control" placeholder="'.$data['placeholder2'].'" value="'.$data['value2'].'" aria-describedby="basic-default-password">
                            <span class="input-group-text">'.$data['value_type2'].'</span>
                        </div>
                    </div>
                </div>
            ';
            break;
        case "select2":
            $result='
                <div class="mb-1" style="'.$data['style'].'">
                    <label class="form-label" for="'.$data['name'].'">'.$data['name_visual'].'</label>
                    <select '.$data['attr'].' class="select2 form-select" name="'.$data['name'].'">
                        '.$data['first_option'];
            foreach ($data['options'] as $option) {
                $selected="";
                if($option['value']==$data["value"]) $selected="selected";
                $result.='<option value="'.$option['value'].'" '.$selected.'>'.$option['text'].'</option>';
            }

            $result.='
                    </select>
            ';

            if($data['label']!="")
                $result.='
                    <p><small class="text-muted">'.$data['label'].'</small></p>
            ';

            $result.='
                </div>
            ';
            break;
        case "hr":
            $result='<hr>';
            break;
    }
    return $result;
}

function createFormBlock($size, $data, $header="") {
    $result='<div class="'.$size.'">';
    if($header!="") $result.=$header;
    foreach ($data as $datum) {
        $result.=$datum;
    }
    $result.='</div>';
    return $result;
}

function createFormRow($data) {
    $result='<div class="row">';
    foreach ($data as $datum) {
        $result.=$datum;
    }
    $result.='</div>';
    return $result;
}
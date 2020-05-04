<?php
function build_table($table_name)
{
    $CI =& get_instance();
    $CI->load->model("Database_model");
    $table_columns = $CI->Database_model->get_columns($table_name);
    $table_columns_dataport_data = array();
    foreach ($table_columns as $key => $value) {
        $dataport = $CI->Database_model->get_dataport_of_column($table_name, $value);
        if ($dataport !== "") {
            $col_data = explode(".", $dataport);
            $table_columns_dataport_data[$value] = $CI->Database_model->get_column($col_data[0], $col_data[1]);
        }
    }
    
    
    
    //INSERT RÉSZ
    echo "<div id='showdata'></div>";
    echo '<button type="button" onclick="add_row(\'kiskacsa\')" class="btn btn-success">'.lang("insert").'</button>';
    echo "<div style='border:1px solid black'>";
    echo lang("insert");

    echo "<table><tr>";
    foreach ($table_columns as $key => $value) {
        echo "<th class=''>" . strtoupper($value) . "</th>";
    }
    echo "</tr><tr><form>";

    foreach ($table_columns as $key => $value) {

        if ($value == "id") {
            echo "<td><input value='' id='$value-input' name='$value' readonly></td>";
        } else if (!sizeof($table_columns_dataport_data[$value]) > 0) {
            echo "<td><input type='text' id='$value-input' name='$value'></td>";
        } else {
            echo "<td><select name='$value-value' id='$value-input'>";
            foreach ($table_columns_dataport_data[$value] as $key2 => $value2) {
                echo "<option>" . flatten($table_columns_dataport_data[$value][$key2])[0] . "</option>";
            }
            echo "</select></td>";
        }
    }
    echo "</form></tr>";
    echo "</table>";
    echo "</div>";
    //EDIT RÉSZ
    echo "<div style='border:1px solid black'>";
    echo lang("edit");
    echo "<table><tr>";
    foreach ($table_columns as $key => $value) {
        echo "<th class=''>" . strtoupper($value) . "</th>";
    }
    echo "</tr><tr><form>";
    foreach ($table_columns as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</form></tr>";
    echo "</table>";
    echo "</div>";
    //END__________
    echo " <table id=\"table-container\" class=\"table-dark px-4 py-4 table-striped table table-active\">
            <thead>
            <tr>";
    foreach ($table_columns as $key => $value) {
        echo "<td class=''>" . strtoupper($value) . "</td>";
    }
    echo "<td class=''>" . strtoupper("buttons") . "</td>";
    echo " </tr>\n</thead>\n<tbody>\n</tbody>\n</table>

        <script>
            $(document).ready(function () {
                $('#table-container').DataTable({
                    \"ajax\": {
                        url: '" . base_url("database/get_table_json/" . $table_name) . "',
                        type: 'GET'
                        
                    },


                    \"columns\": [";
    foreach ($table_columns as $key => $value) {
        echo "{'data':'$value'},\n";
    }
    
    echo '
    {\'data\' : \'buttons\'}
                    ]
                });
                
            });
            function add_row(text){
                
                    Swal.fire({
                        title: \''.lang("insert_row").'\',
                        icon: \'info\',
                        html: \'';
                        // <form> <div style="overflow-y: scroll; height:400px;" > <div class="permission-add-alert-div"> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput">Example label</label> <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input"> </div> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput2">Another label</label> <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input"> </div> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput2">Another label</label> <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input"> </div> <hr> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput">Example label</label> <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input"> </div> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput2">Another label</label> <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input"> </div> <div class="form-group "> <label class="permission-add-alert-label" for="formGroupExampleInput2">Another label</label> <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input"> </div> <br> </div> </div> </form> \',
                        echo '<form id="insert_row_form"><div style="overflow-y: auto; height:400px;"><div class="permission-add-alert-div"><input type="hidden" name="insert_row">';
                        foreach($table_columns as $key => $value){
                           //LABEL
                            echo '<div class="form-group "><label class="'.$value.'-add-alert-label" for="formGroup'.$value.'Input">'.$value.'</label></div>';
                           //INPUTS
                            if ($value == "id") {
                                echo "<input value=\'";
                                echo flatten($CI->Database_model->get_last_row($table_name))[0]+1;
                            echo "\' id=\'formGroup".$value."Input\' class=\'form-control\' name=\'$value\' readonly>";
                            } else if (!sizeof($table_columns_dataport_data[$value]) > 0) {
                                echo "<input type=\'text\' id=\'formGroup".$value."Input\' class=\'form-control\' name=\'$value\'>";
                            } else {
                                echo "<select name=\'$value-value\' class=\'form-control\' id=\'formGroup".$value."Input\'>";
                                foreach ($table_columns_dataport_data[$value] as $key2 => $value2) {
                                    echo "<option>" . flatten($table_columns_dataport_data[$value][$key2])[0] . "</option>";
                                }
                                echo "</select>";
                            }
                        }
                            echo '</div></div></form>';
                        
                        echo '\',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: \''.lang("done").'\',
                        cancelButtonText: \''.lang("cancel").'\',
                    }).then((result) => {
                        if (result.value) {
                            var form = $("#insert_row_form");
                            $.ajax({
                                url: \''.base_url("database/upload_row/").'\',
                                data: form.serialize(),
                                type: \'POST\',

                                success: function(data) {
                                    $(\'#showdata\').html(data);
                                },
                                error: function(e) {
                                    alert(\'Error: \'+data);
                                }  
                            });
                        }
                
               
            })}
        </script>
        <style>
    /* width /
    ::-webkit-scrollbar {
        width: 10px;
    }

    / Track /
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    / Handle /
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    / Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .permission-add-alert-div {
        margin-left: 1vw;
        margin-right: 1vw;
    }

    .permission-add-alert-label {
        float: left !important;
    }
</style>';
        
}
function nice_to_normal($str)
{
    $unwanted_array = array(
        'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'Ő' => 'o', 'ő' => 'o', 'Ű' => 'u', 'ű' => 'u', 'Ü' => 'u', 'ü' => 'u', ' ' => '_'
    );
    return strtolower(strtr($str, $unwanted_array));
}
function flatten(array $array)
{
    $return = array();
    array_walk_recursive($array, function ($a) use (&$return) {
        $return[] = $a;
    });
    return $return;
}
function flatten_with_self(array $array)
{
    $return = array();
    foreach (flatten($array) as $key => $value) {
        $return[$value] = $value;
    }

    return $return;
}
function console_log($message)
{
    echo "<script>";
    echo "console.log($message)";
    echo "</script>";
}


<?php
/*foreach($data as $key=> $value){
    echo "$key" . " -> " . "$value <br>";
}*/
require_login();
$this->load->helper("form");
if(!has_permission("upload_permission")){
    echo "<div style='border:1px solid black'> <h3>Add Permission</h3>";
    echo form_open("account/profile");
    echo "Permission_name: ";
    echo form_input(array("type"=>"text", "name"=>"permission_name"));
    echo "<br>";
    echo form_submit('upload_permission', 'OK');
    echo form_close();
    echo "</div>";
}
if(has_permission("add_user_to_ugroup")){
    echo "<div style='border:1px solid black'> <h3>Add User To UGroup</h3>";
    echo form_open("account/profile");
    echo "User: ";
    echo form_dropdown("user", flatten_with_self($users));
    echo "<br>";
    echo "Group: ";
    echo form_dropdown("ugroup", flatten_with_self($groups));
    echo "<br>";
    echo form_submit('add_user_to_ugroup', 'OK');
    echo form_close();
    echo "</div>";
}
?>

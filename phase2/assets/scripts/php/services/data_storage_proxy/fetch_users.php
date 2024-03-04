<?php
session_start();

$token = $_SESSION["token"];
$xtoken = $_SESSION["xtoken"];

$proxy = "data-storage-proxy";
$port = "3020";
$userid = $_SESSION['id'];

$data = json_encode(array('token' => $xtoken));
$curl = curl_init("http://".$proxy.":".$port."/api/user/get_all.php");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));
$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response, true);
$res = "";
if ($result && !array_key_exists('message',$result) && count($result) > 0) {
    foreach($result as $data) { //data
        foreach($data as $doc){ //num
            $user_id = $doc['id'];
            $is_confirmed = $doc['confirmed'];
            $username = $doc['username'];
            $email = $doc['email'];
            $role = $doc['role'];
            $description = ($doc['description'] == '') ? "Empty" : $doc['description'];
            $website = ($doc['website'] == '') ? "Empty" : $doc['website'];


            $res .= "<tr><td class = \"invisible\">" .
            $user_id .
            '</td><td>' .
            $username .
            '</td><td>' .
            $email .
            '</td><td class="role">' .
            '<span class="role-span" >' .$role. '</span>'. 
            '<select class = "role-select" onchange= "getSelected(this)" hidden>
            <option value="0">Select Role</option>
            <option value="1">User</option>
            <option value="2">Seller</option>
            <option value="3">Admin</option>
            </select>'.
            '</td><td>' .
            $description .
            '</td><td>' .
            $website .
            '</td><td>';

            $res .= $is_confirmed ? 
            "<div id = $user_id class=\"confirmed\">" :
            "<div id = $user_id>";

            $res .= $is_confirmed
                ? "<a id = $user_id value=\"edit\" class = \"edit-btn\" title=\"Edit\" onclick=\"change_btns(this)\"><i class=\"fas fa-edit\" id = \"edit-svg\"></i></a>
                <a id = $user_id value=\"save\" class = \"save-btn invisible\" title=\"Save\" onclick=\"change_btns(this)\"><i class=\"fas fa-save\" id = \"save-edit-svg\"></i></a>  
                <a id = $user_id value=\"reject\" class = \"reject-btn-edit invisible\" title=\"Cancel\" onclick=\"change_btns(this)\"><i class=\"fas fa-times\" id = \"cancel-edit-svg\"></i></a>
                <a value=\"delete\" class = \"delete-btn\" title=\"Remove\"><i class=\"fas fa-user-slash\"></i></a>"
                : "<a value=\"approve\" class = \"approve-btn\" title=\"Confirm\"><i class=\"fas fa-check\"></i></a>
                <a value=\"reject\" class = \"reject-btn\" title = \"Reject\"><i class=\"fas fa-times\"></i></a>";
            $res .= '</div>';
            $res .= '</td></tr>';
        }
    }
    // Check Encode
    echo $res;
    // ?echo file_exists("../../../_images/products/63bc8f5eae3ec141778222eb.jpg") ? "true" : "false";
}
else {
    echo '<h1>'.$result['message'].'</h1>';
}

    
?>
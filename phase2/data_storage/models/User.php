<?php
    class User{
      private $token;
     
      public $appID =            "dc7c8057-6cc5-40f9-92b9-ec7ef20e284c";
      public $orgEstoreUsers =   "71724de7-e4da-441b-85e3-f116450f319d";
      public $orgEstoreSellers = "77d79aa8-7b3e-4938-9680-0a5ae06cd59f";
      public $roleUserID =       "ce55c887-6ce9-422a-bb55-27c3ab38456f";
      public $roleSellerID =     "641e26e5-0063-44ff-991a-47bc50f4f377";
      public $roleAdminID =      "d8404574-8bbd-4096-916f-9a2f4ab0583a";
      public $keyrock_port = "3005";

      // Constructor to get access to functions
      public function __construct($token) {
        $this->token = $token;
    }


      // ================================================= Get User Info ==================================================

      private function getRole($role_id){
        // If authed search in authorized=> if not there then confirmed = false and look for role in orgs
        if($role_id == $this->roleUserID)
          return "User";
        else if($role_id == $this->roleSellerID)
          return "Seller";
        else return "Admin";
      }
      // Get authorized users
      private function getAuthorized($user_id){
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/applications/".$this->appID."/users/".$user_id."/roles");
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($curl, CURLOPT_HEADER, FALSE);
      
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          "X-Auth-token: ".$this->token.""
          ));
      
          $response = curl_exec($curl);
          curl_close($curl);
          $result = json_decode($response, true);
          $user_item = null; 
          foreach($result as $key){
            foreach($key as $doc){
              if(!empty($doc['role_id'])){
                $role = $this->getRole($doc['role_id']);
                $user_item = ['role' => $role, 'confirmed' => true];
              }
            }
          }
          return $user_item;
      }

      private function getUnauthorizedOrg($org_id,$user_id){
        // Check in Users
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/organizations/".$org_id."/users/".$user_id."/organization_roles");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "X-Auth-token: ".$this->token.""
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        
        $user_item = null;
        foreach($result as $doc){
          if(!empty($doc['role'])){
              if($org_id == $this->orgEstoreUsers){
                $role = ($doc['role'] == 'member') ? "User" : "Admin";
                $user_item = ['role' => $role, 'confirmed' => false];
              }
              else{ 
                $role = ($doc['role'] == 'member') ? "Seller" : "Admin";
                $user_item = ['role' => $role, 'confirmed' => false];
              }
          }
        }
        return $user_item;
      }


      // Get authorized users
      private function getUnauthorized($user_id){
        // Check in Users
        $user_item = $this->getUnauthorizedOrg($this->orgEstoreSellers,$user_id);
        if($user_item)
          return $user_item;
        
        // If not in Users
        $user_item = $this->getUnauthorizedOrg($this->orgEstoreUsers,$user_id);
        return $user_item;
      }

      private function getCreds($user_id){
        // If authed search in authorized=> if not there then confirmed = false and look for role in orgs
        $creds= null;
        $creds = $this->getAuthorized($user_id);
        if(!$creds){
          $creds = $this->getUnauthorized($user_id);
        }
        return $creds;
      
      }

      public function getUserInfo(){
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/users");
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($curl, CURLOPT_HEADER, FALSE);
          
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "X-Auth-token: ".$this->token.""
          ));
          
          $response = curl_exec($curl);
          curl_close($curl);
          $result = json_decode($response,true);
          $user_data =array();
          $user_data['data'] =array();
          
          foreach($result as $key){
            foreach($key as $doc){
              $user_item = null;
              $user = $this->getCreds($doc['id']);
              
              if($user){
                $user_item = array('id' =>$doc['id'],'username' => $doc['username'], 'email'=> $doc['email'], 
                              'role'=> $user['role'], 'confirmed'=> $user['confirmed'], 'description' => $doc['description'],
                               'website'=> $doc['website']);
                array_push($user_data["data"], $user_item);
              }
            }
          }
          return $user_data['data'];
        }

        // ================================================= Delete User ==================================================
        public function deleteUser($user_id){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/users/".$user_id."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
          
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Auth-token: ".$this->token.""
          ));

          curl_exec($ch);
          if(curl_errno($ch)){
            return null;
            curl_close($ch);
          }
          curl_close($ch);
          return "SUCCESS";
        }


        // ================================================= Add User ==================================================
        public function addUser($user_id){
          // Check if in estoreUsers
          if(!$this->addFromOrg($user_id,$this->orgEstoreUsers)){ // if not in sellers queue
            if($this->addFromOrg($user_id,$this->orgEstoreSellers)){ 
              // if done return true
              return true;
            } 
            else {
              return false;}
          }
          return true;
        }


        private function addFromOrg($user_id,$org){
          $item = $this->getUnauthorizedOrg($org, $user_id); // get [role]
          // if true add in app users, and remove from org. 
          if($item){
            $auth_flag = $this->authorizeUser($user_id,$item['role']);
            $rem_flag = $this->removeFromOrg($user_id,$org,$item['role']);
            if($auth_flag && $rem_flag){ // If entered without problem
              return true;
            }
            else{
              return false;
            } 
          }
          return false;
        }


        private function authorizeUser($user_id,$role){
          $ch = curl_init();
          $role_id ='';
          if($role == "User"){
              $role_id = $this->roleUserID;
          }
          else if($role == "Seller"){
            $role_id = $this->roleSellerID;
          }
          else $role_id = $this->roleAdminID;

          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/applications/".$this->appID."/users/".$user_id."/roles/".$role_id."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "X-Auth-token: ".$this->token.""
          ));
          
          curl_exec($ch);
          
          if(curl_errno($ch)){
            return null;
          }
          else return true;
        }

        private function removeFromOrg($user_id,$org,$role){
          $ch = curl_init();
          if($role == 'Admin'){
            $org_role = "owner";
          }
          else{
            $org_role = "member";
          }
          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/organizations/".$org."/users/".$user_id."/organization_roles/".$org_role."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
          
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Auth-token: ".$this->token.""
          ));

          
          curl_exec($ch);

          // remove from both
          if($role == "Admin"){
            if($org == $this->orgEstoreSellers)
              curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/organizations/".$this->orgEstoreUsers."/users/".$user_id."/organization_roles/".$org_role."");
            else
              curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/organizations/".$this->orgEstoreSellers."/users/".$user_id."/organization_roles/".$org_role."");
          }
          curl_exec($ch);

          if(curl_errno($ch)){
            curl_close($ch);
            return null;
          }
          return true;
          curl_close($ch);    
        }

        // ================================================= Update User ==================================================

        private function updateUserInfo($user_id,$username,$email,$description, $website){
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/users/".$user_id."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

          curl_setopt($ch, CURLOPT_POSTFIELDS, "{
            \"user\": {
              \"username\": \"".$username."\",
              \"email\": \"".$email."\",
              \"description\": \"".$description."\",
              \"website\": \"".$website."\"
            }
          }");

          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "X-Auth-token: ".$this->token.""
          ));
          $response = curl_exec($ch);
          $ret =null;
          if(curl_errno($ch)){
            curl_close($ch);
          }
          else{
            curl_close($ch); 
            $ret = true;
          }
          return $ret;
        }

        private function getRoleID($role){
          $role_id = null;
          if($role == "User"){
            $role_id = $this->roleUserID;
          }else if($role == "Seller"){
            $role_id = $this->roleSellerID;
          } 
          else{
            $role_id = $this->roleAdminID;
          }
          return $role_id;
        }

        private function removeUserRole($user_id,$role){
          $ch = curl_init();
          $role_id = $this->getRoleID($role);
          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/applications/".$this->appID."/users/".$user_id."/roles/".$role_id."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);

          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-Auth-token: ".$this->token.""
          ));

          $response = curl_exec($ch);

          if(curl_errno($ch)){
            curl_close($ch);
            return null;
          }
          curl_close($ch); 
          return true;
        }
        private function addUserRole($user_id,$role){
          
          $ch = curl_init();

          $role_id = $this->getRoleID($role);
          
          curl_setopt($ch, CURLOPT_URL, "http://keyrock:".$this->keyrock_port."/v1/applications/".$this->appID."/users/".$user_id."/roles/".$role_id."");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "X-Auth-token: ".$this->token.""
          ));
          $response = curl_exec($ch);

          if(curl_errno($ch)){
            curl_close($ch);
            return null;
          }
          curl_close($ch); 
          return true;
        }

        private function updateUserRole($user_id,$role){
          // check if new role same with old 
          $old_role = $this->getAuthorized($user_id)['role'];

          if($old_role == $role){
            return true;
          }
          if($this->addUserRole($user_id,$role) && $this->removeUserRole($user_id,$old_role)){
            return true;
          }
          return false;
        }

        public function updateUser($user_id,$username,$email,$role,$description, $website){
          $info = $this->updateUserInfo($user_id,$username,$email,$description, $website);
          $role = $this->updateUserRole($user_id,$role);

          if($info && $role){
            return true;
          }
          return null;
        }
        
    }


?>
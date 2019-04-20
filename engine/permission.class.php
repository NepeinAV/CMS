<?php
    class Permission
    {
        public function hasPermission($permission_name)
        {
            global $DB;
            $user_id = $this->user;
            $result = $DB->query("select id from user_permissions where user_id=\"$user_id\" and permission_id=(select permission_id from permissions where permission=\"$permission_name\")");
            return boolval($result->num_rows);
        }
    }

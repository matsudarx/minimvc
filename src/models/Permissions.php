<?php

class Permissions
{
    public static function isAccessible($appname, $username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT count(*) as isaccessible FROM permissions_access JOIN permissions_app USING(id_app) JOIN permissions_user USING(id_user) WHERE app_name = :app_name AND user_name = :user_name");
        $stmt->execute([
            "app_name" => $appname,
            "user_name" => $username,
        ]);
        return $stmt->fetch(PDO::FETCH_NUM)[0];
    }
    public static function isPermitted($appname, $username, $typename)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT count(*) as ispermitted FROM permissions_access JOIN permissions_type USING(id_type) JOIN permissions_app USING(id_app) JOIN permissions_user USING(id_user) WHERE app_name = :app_name AND user_name = :user_name AND (type_name = :type_name OR type_name = 'admin')");
        $stmt->execute([
            "app_name" => $appname,
            "user_name" => $username,
            "type_name" => $typename
        ]);
        return $stmt->fetch(PDO::FETCH_NUM)[0];
    }
    public static function getRightsByUser($appname, $username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT type_name FROM permissions_access JOIN permissions_app USING(id_app) JOIN permissions_user USING(id_user) JOIN permissions_type USING(id_type) WHERE app_name = ? AND id_user = ?");
        $stmt->execute([$appname, $username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllFolderByUser($username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT DISTINCT folder_name FROM permissions_user JOIN permissions_access USING(id_user) JOIN permissions_app USING(id_app) JOIN permissions_folder using(id_folder) WHERE user_name = ? ORDER BY id_folder");
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getAllAppByFolderByUser($foldername, $username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT DISTINCT app_name FROM permissions_user JOIN permissions_access USING(id_user) JOIN permissions_app USING(id_app) JOIN permissions_folder using(id_folder) WHERE folder_name = ? AND user_name = ? ORDER BY id_app");
        $stmt->execute([$foldername, $username]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getIdByAppname($appname)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT id_app FROM permissions_app WHERE app_name = ?");
        $stmt->execute([$appname]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    public static function getIdByUsername($username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT id_user FROM permissions_user WHERE user_name = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    public static function getIdByFoldername($foldername)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT id_folder FROM permissions_folder WHERE folder_name = ?");
        $stmt->execute([$foldername]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    public static function getIdByTypename($typename)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("SELECT id_type FROM permissions_type WHERE type_name = ?");
        $stmt->execute([$typename]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    public static function fromCamelcase($string)
    {
        return ucfirst(strtolower(preg_replace('/([A-Z])/', ' $1', $string)));
    }
    public static function getAllUsername()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT user_name FROM permissions_user ORDER BY user_name");
        return $res->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getAllUser()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT id_user, group_name, user_name, user_update FROM permissions_user JOIN permissions_group USING (id_group) ORDER BY user_update DESC");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllAppname()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT app_name FROM permissions_app ORDER BY app_name");
        return $res->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getAllApp()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT id_app, folder_name, app_name, app_update FROM permissions_app JOIN permissions_folder USING(id_folder) ORDER BY app_update DESC");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllFoldername()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT folder_name FROM permissions_folder ORDER BY folder_name");
        return $res->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getAllFolder()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT id_folder, folder_name, folder_update FROM permissions_folder ORDER BY folder_update DESC");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllTypename()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT type_name FROM permissions_type ORDER BY type_name");
        return $res->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function getAllType()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT id_type, type_name, type_update FROM permissions_type ORDER BY type_update DESC");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getAllAccess()
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->query("SELECT id_access, user_name, app_name, folder_name, type_name, access_update FROM permissions_access JOIN permissions_user USING (id_user) JOIN permissions_app USING (id_app) JOIN permissions_type USING (id_type) JOIN permissions_folder USING (id_folder) ORDER BY access_update DESC");
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getIdGroupByName($groupe)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $res = $db->prepare("SELECT id_group FROM permissions_group WHERE group_name = ?");
        $res->execute([$groupe]);
        return $res->fetchAll(PDO::FETCH_COLUMN)[0];
    }
    public static function insertAccess($username, $appname, $typename)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $idUser = Permissions::getIdByUsername($username);
        $idApp = Permissions::getIdByAppname($appname);
        $idType = Permissions::getIdByTypename($typename);
        $stmt = $db->prepare("INSERT INTO permissions_access (id_user, id_app, id_type) VALUES (?,?,?)");
        $stmt->execute([$idUser, $idApp, $idType]);
    }
    public static function updateAccess($username, $appname, $typename, $idAccess)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $idUser = Permissions::getIdByUsername($username);
        $idApp = Permissions::getIdByAppname($appname);
        $idType = Permissions::getIdByTypename($typename);
        $stmt = $db->prepare("UPDATE permissions_access SET id_user = ?, id_app = ?, id_type = ? WHERE id_access = ?");
        $stmt->execute([$idUser, $idApp, $idType, $idAccess]);
    }
    public static function deleteAccess($idAccess)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("DELETE FROM permissions_access WHERE id_access = ?");
        $stmt->execute([$idAccess]);
    }
    public static function duplicateAccess($idAccess, $username)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("INSERT INTO permissions_access (id_user, id_app, id_type) SELECT ?, id_app, id_type FROM permissions_access WHERE id_access = ?");
        $IdUser = Permissions::getIdByUsername($username);
        $stmt->execute([$IdUser, $idAccess]);
    }
    public static function insertUser($username, $group)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $idGroup = Permissions::getIdGroupByName($group);
        $stmt = $db->prepare("INSERT INTO permissions_user (user_name, id_group) VALUES (?,?)");
        $stmt->execute([$username, $idGroup]);
    }
    public static function insertApp($appname, $foldername)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $idFolder = Permissions::getIdByFoldername($foldername);
        $stmt = $db->prepare("INSERT INTO permissions_app ('id_folder', 'app_name') VALUES (?,?)");
        $stmt->execute([$idFolder, $appname]);
    }
    public static function insertFolder($foldername)
    {
        $db = new PDO("mysql:host=" . $_ENV['SERVER'] . ";dbname=" . $_ENV['DB'], $_ENV['USER_DB'], $_ENV['PASSWD_DB']);
        $stmt = $db->prepare("INSERT INTO permissions_folder ('folder_name') VALUES (?)");
        $stmt->execute([$foldername]);
    }
}
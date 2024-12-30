<?php
class form {
    public static function is_not_empty(array $array , string $method) : bool
    {
        $data = $method === 'POST' ? $_POST : $_GET;
        foreach ($array as $arr) {
            if(isset($data[$arr]) and !empty($data[$arr])){
                return true ;
            } 
           
        }
        return false ;
    }
}

class db{
    public static function get (string $requete ,PDO $database ) 
    {
        
        $data = $database->prepare($requete) ;
        $data ->execute();
        return $data->fetch() ;
    }
    public static function get_All (string $requete ,PDO $database ) 
    {
        $data = $database->prepare($requete) ;
        $data ->execute();
        return $data->fetchAll() ;
    }

}

?>
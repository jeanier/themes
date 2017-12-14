<?php
class usuariosSql
{
    public static function  indentificarUsuario()
    {
        $query="SELECT * FROM doo_admin WHERE 	username=? AND password=?";
        return $query;
    }

    public static function  registrarUsuario()
    {
        $query="CALL insertarCustomers (?,?)";
        return $query;
    }

    public static function validateIfExistsUser()
    {
        $query = "SELECT * FROM doo_admin WHERE username=?";
        return $query;
    }
}
?>

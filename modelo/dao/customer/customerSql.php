<?php
class customerSql
{
    public static function  indentificarCustomer()
    {
        $query="SELECT * FROM doo_payments WHERE 	payment_id=? AND customer_id=?";
        return $query;
    }

    public static function  registrarCustomer()
    {
        $query="CALL insertarCustomers (?,?,?,?,?,?,?,?,?)";
        return $query;
    }

    public static function validateIfExistsCustomer()
    {
        $query = "SELECT * FROM doo_payments WHERE customer_id=?";
        return $query;
    }
}
?>

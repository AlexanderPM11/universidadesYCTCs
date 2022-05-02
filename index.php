<?php


class ConexionDb
{
    private $servidor = "sql102.epizy.com";
    private $user = "epiz_31474526";
    private $password = "799rsqVGtlw8";
    private $conexion;
    function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=epiz_31474526_gestion_caso_abogado", $this->user, $this->password);
            // echo "Connected successfully" . "<br>";
        } catch (PDOException $e) {
            echo ("Haz ocurrido un error.." . $e->getMessage());
        }
    }
    public function ejecutar($sql)
    {
        $this->conexion->query($sql);
        return $this->conexion;
    }
    public function showDatos($sql)
    {
        $select = $this->conexion->prepare($sql);
        $select->execute();
        $result = $select->fetchAll();
        return $result;
    }
}


$con = new ConexionDb();

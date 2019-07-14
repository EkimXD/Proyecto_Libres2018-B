<?php

require_once 'clase_conexion.php';

class Administrador {

    private $id;
    private $usuario;
    private $contrasenia;
    private $tipo;
    private $estaActivo;

    const tabla = 'usuario';

    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getContrasenia() {
        return $this->contrasenia;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getEstaActivo() {
        return $this->estaActivo;
    }

    // generando setters

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setContrasenia($contrasenia) {
        $this->contrasenia = $contrasenia;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setEstaActivo($estaActivo) {
        $this->estaActivo = $estaActivo;
    }

    //constructor
    public function __construct($usuario, $contrasenia, $tipo = 'ADM', $estaActivo = 'V', $id = null) {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        $this->tipo = $tipo;
        $this->estaActivo = $estaActivo;
    }

    public function guardar() {
        $conexion = new Conexion();
        $statement = 'INSERT INTO usuario (usuario, contrasenia, tipo_usuario, activo) VALUES (?, ?, ?, ?)';

        $consulta = $conexion->prepare($statement);
        //$consulta->bindColumn(':usuario', 'usuario');

        $consulta->execute(array($this->usuario, $this->contrasenia, $this->tipo, $this->estaActivo));

        $conexion = null;
    }

    //funciones de guardado
    /* public function guardar() {
      $conexion = new Conexion();
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
      if ($this->id) {//modificar
      $consulta = $conexion->prepare('UPDATE usuario SET  usuario = :usuario,contrasenia=:contrasenia, tipo_usuario=:tipo_usuario, activo=:activo WHERE idUsuario = :id');
      $consulta->bindParam(':usuario', $this->usuario);
      $consulta->bindParam(':contrasenia', $this->contrasenia);
      $consulta->bindParam(':tipo_usuario', $this->tipo);
      $consulta->bindParam(':activo',$this->estaActivo);
      $consulta->bindParam(':id', $this->id);
      if($consulta->execute()){
      echo 'se ejecuta actualizacion\n';
      }else
      {
      //print_r($conexion->errorInfo());
      print_r($consulta->errorInfo());

      }
      } else {//insertar
      $consulta = $conexion->prepare('INSERT INTO '.self::tabla.' ( usuario, contrasenia,tipo_usuario,activo) VALUES(:usuario,:contrasenia,:tipo,:activo)');
      $consulta->bindParam(':usuario', $this->usuario);
      $consulta->bindParam(':contrasenia', $this->contrasenia);
      $consulta->bindParam(':tipo_usuario', $this->tipo);
      $consulta->bindParam(':activo',$this->estaActivo);
      if($consulta->execute()){
      echo 'se ejecuta insercion ';
      }else
      {
      print_r($consulta->errorInfo());

      }
      $this->id=$conexion->lastInsertId();
      }
      $conexion = null;
      }
     */
    public function presentarAdmins() {
        $conexion = new Conexion();
        $statement = 'SELECT * FROM  usuario';
        $consulta = $conexion->prepare($statement);
        $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $consulta->execute();
        
        //$consulta->bindColumn(':usuario', 'usuario');
        if ($consulta->rowCount() != 0) {
            echo "<table><tr><th>ID</th><th>user</th><th>pass</th><th>boton</th></tr>";
            while ($row = $consulta->fetch()) {
                echo "<tr><td>".$row["idUsuario"]."</td><td>".$row["usuario"]."</td><td>".$row["contrasenia"]."</td><td><input type=\"submit\"></td></tr>";
            }
            echo "</table>";
        } else {
            echo "don't exist records for list on the table";
        }

        $consulta->execute(array($this->usuario, $this->contrasenia, $this->tipo, $this->estaActivo));

        $conexion = null;
    }

    public static function buscarPorId($id) {
        $conexion = new Conexion();
        $consulta = $conexion->prepare('SELECT * FROM usuario WHERE id = :id');
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $registro = $consulta->fetch();
        if ($registro) {
            return new self($id, $registro['usuario'], $registro['contrasenia'], $registro['tipo_usuario'], $registro['activo']);
        } else {
            return false;
        }
        $conexion = null;
    }

}

?>
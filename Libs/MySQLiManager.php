<?php

class MySQLiManager {

    private $link;

    public function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) {
        $this->DB_HOST = $DB_HOST;
        $this->DB_USER = $DB_USER;
        $this->DB_PASS = $DB_PASS;
        $this->DB_NAME = $DB_NAME;
        $this->link = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    function __destruct() {
        $thread_id = $this->link->thread_id;
        $this->link->kill($thread_id);
        $this->link->close();
    }

    function select($attr, $table, $where = '') {

        $where = ($where != '' || $where != null) ? "WHERE " . $where : '';
        //$stmt = "SELECT " . $attr . " FROM " . $table . " " . $where;
        $stmt = "SELECT $attr FROM $table $where";
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
            return $response;
        }
    }

    function selectMax($attr, $table) {
       
        $stmt = "SELECT * FROM " . $table . " where $attr like'".date('y')."%' order by " . $attr . " DESC limit 1";        
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response[] = $row;
        } else {
            $response[] = null;
        }
        return $response;
    }
    
    function selectMax2($attr, $table) {
       
        $stmt = "SELECT * FROM " . $table . " order by " . $attr . " DESC limit 1";        
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response[] = $row;
        } else {
            $response[] = null;
        }
        return $response;
    }

    function BusquedaTabla($table, $Sintaxis) {

        //$stmt = "SELECT * FROM " . $table . " where " . $Sintaxis;
           
        $stmt = "SELECT * FROM $table WHERE $Sintaxis";
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }            
        } else {
            $response[] = null;
        }
        
        
        return $response;
    }
    
    function BusquedaTablaRelacionada($procedimiento,$campo) {            
        //$stmt = "CALL $procedimiento('$campo')";
        //$stmt = "CALL BuscarCentroCostos('$campo')";
       $stmt = $procedimiento;
        
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
            return $response;
        }
    }

    function insert($table, $values, $where = '', $sanear = false) {

        $columnas = null;
        $valores = null;

        foreach ($values as $key => $value) {
            $columnas.=$key . ',';
            if ($sanear == true) {
                $valores.='"' . ucwords(strtoupper($value)) . '",';
            } else {
                $valores.='"' . $value . '",';
            }
        }
        $columnas = substr($columnas, 0, -1);
        $valores = substr($valores, 0, -1);

        $stmt = "INSERT INTO " . $table . " (" . $columnas . ") VALUES(" . $valores . ") " . $where . ";";

        //$result = $this->link->query($stmt) or die($this->link->error.__LINE__);
        $result = $this->link->query($stmt) or die($this->link->error);

        //TODO: Eval Insert Exec.
//                if($result->num_rows > 0) {
//			$response = false;
//		}
//		else {
        $response = true;
//		}

        return $response;
    }

    function updateAvanzado($table, $values, $where) {

        foreach ($values as $key => $value) {
            $valores .= $key . '="' . $value . '",';
        }
        $valores = substr($valores, 0, strlen($valores) - 1);
        $stmt = "UPDATE $table SET $valores WHERE $where";
    
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
       
        if (count($result)>0) {
            $response = true;
        } else {
            $response = false;
        }

        return $response;
    }

    function update($table, $data, $where) {

        $stmt = "UPDATE " . $table . " SET " . $data . " WHERE " . $where;

        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);

        if (count($result) > 0) {
            $response = true;
        } else {
            $response = false;
        }

        return $response;
    }


    function delete($table, $values) {


        $stmt = 'DELETE FROM ' . $table . ' WHERE ' . $values;
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);

        if (count($result) > 0) {
            $response = true;
        } else {
            $response = false;
        }

        return $response;
    }

    function check($what, $table, $values, $complex = false) {

        if ($complex) {
            $where = $values;
        } else {
            foreach ($values as $key => $value) {
                $where = $key . '="' . $value . '"';
            }
        }

        $stmt = "SELECT " . $what . " FROM " . $table . " WHERE " . $where;
        $result = $this->link->query($stmt) or die($this->link->error . __LINE__);
        if ($result->num_rows > 0) {
            $response = true;
        } else {
            $response = false;
        }

        return $response;
    }
    
    
    
    ///////////////////////////////////////////
    
    function insertReq($table, $data) {
                                                                                      
//            $Requerimiento_Id = $data["Requerimiento_Id"];
//            $FechaRequerimiento = $data["FechaRequerimiento"];
//            $FechaAprobacion = $data["FechaAprobacion"];
//            $Trabajador_Id = $data["Trabajador_Id"];
//            //$data["Detalle"] = $_POST["Detalle"];
//            $Descripcion = $data["Descripcion"];
//            $Area_Id = $data["Area_Id"];
//            $CentroCostos_Id = $data["CentroCostos_Id"];
//            $EstadoAprobacion = $data["EstadoAprobacion"];
//                
//
//                $query = "insert into $table(Requerimiento_Id,FechaRequerimiento,FechaAprobacion,Trabajador_Id,Descripcion,Area_Id,CentroCostos_Id,EstadoAprobacion) "
//                        . "values($Requerimiento_Id,'$FechaRequerimiento','$FechaAprobacion','2','dfdxfdfds',$Area_Id,$CentroCostos_Id,$EstadoAprobacion)";
//
//               if (mysql_query($query)) {
//                   echo "agregado";
//                   $estado=1;
//               } else {
//                   echo "Error: " . $query . "<br>" . mysqli_error($conn);
//               }
//               
               $response = true;
               return $response;
        }
        
        
    function insertCabeDeta($table, $values, $where = '', $sanear = false) {

        $columnas = null;
        $valores = null;

        foreach ($values as $key => $value) {
            $columnas.=$key . ',';
            if ($sanear == true) {
                $valores.='"' . ucwords(strtoupper($value)) . '",';
            } else {
                $valores.='"' . $value . '",';
            }
        }
        $columnas = substr($columnas, 0, -1);
        $valores = substr($valores, 0, -1);

        $stmt = "INSERT INTO " . $table . " (" . $columnas . ") VALUES(" . $valores . ") " . $where . ";";

        //$result = $this->link->query($stmt) or die($this->link->error.__LINE__);
        $result = $this->link->query($stmt) or die($this->link->error);

        //TODO: Eval Insert Exec.
//                if($result->num_rows > 0) {
//			$response = false;
//		}
//		else {
        $response = true;
//		}

        return $response;
    }        
    
    

}

?>
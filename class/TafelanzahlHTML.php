<?php

class TafelanzahlHTML {

    public static function buildTableContent($objects) {
        $html = "<tbody>";
        foreach ($objects['tafelanzahl'] as $pk => $sk) {
            $html .= "
            <tr>
                <td>{$sk->getName()}</td>
                    
                    <td><input type='checkbox' name='ids[]' value='$pk' /></td> 
                    <td><a href='index.php?id=$pk&area=klassenraum&action=showUpdate'>bearbeiten</a></td>
            </tr>";
        }
        $html .= "</tbody>";
        return $html;
    }

    public static function buildDropdown() {
        $db = DbConnect::getConnection();
        $stmttz = $db->prepare("SELECT * FROM tafelanzahl");
        $stmttz->execute();
        $rowstz = $stmttz->fetchAll(PDO::FETCH_ASSOC);
        $tafelanzahl = [];
        echo"<option value='0'></option>";
        foreach ($rowstz as $row) {
            $tafelanzahl[$row['id']] = $row['name'];
            echo'<option value="' . $row['id'] . '"> ' . $row['name'] . ' </option>';
        }
    }
    
    public static function buildDropdown2($klassenraum, $tafel_idAlt = NULL) {
            
        $html = '';
        if (is_null($tafel_idAlt)) {
            $html .= "<option value='0'></option>";
            foreach ($klassenraum as $pk => $sk) {
                $html .= "<option value='$pk' >{$sk->getName()}</option>";
            }
        } else {
            
            $sk_id = $tafel_idAlt;

            foreach ($klassenraum as $pk => $sk) {
                if ($sk_id === $pk) {
                    // bisherige Schulklasse des Schülers
                    $html .= "<option value='$pk' selected>{$sk->getName()}</option>";
                } else {
                    $html .= "<option value='$pk' >{$sk->getName()}</option>";
                }
            }
        } 
       
       
        return $html;
    }


}

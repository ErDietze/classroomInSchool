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

}

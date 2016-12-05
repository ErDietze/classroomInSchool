<?php

class SchulklasseHTML {

    public static function buildTableContent($objects) {
        $html = "<tbody>";
        foreach ($objects['schulklassen'] as $pk => $sk) {
            $html .= "
            <tr>
                <td>{$sk->getName()}</td>
                    <td><input type='checkbox' name='ids[]' value='$pk' /></td> 
                    <td><a href='index.php?id=$pk&area=schulklasse&action=showUpdate'>bearbeiten</a></td>
            </tr>";
        }
        $html .= "</tbody>";
        return $html;
    }

    public static function buildDropdown($schulklassen, $schuelerAlt = NULL) {
        if (is_null($schuelerAlt)) {
            $html = "<option value='0'></option>";
            foreach ($schulklassen as $pk => $sk) {
                $html .= "<option value='$pk' >{$sk->getName()}</option>";
            }
        } else {
            // preselected mit ausgeben
            $html = '';
            $sk_id = $schuelerAlt->getSchulklasse_id();
            
            foreach ($schulklassen as $pk => $sk) {
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

    
//
//    public static function buildDropdownPreselected($schule, $klassenID) {
//        $html = "";
//        for ($index = 0; $index < count($schule); $index++) {
//            $wert = $index + 1;
//            if ($index == $klassenID) {
//                $selected = "selected";
//            } else {
//
//                $selected = "";
//            }
//            $html .= "<option value=$wert $selected>{$schule[$index]->getName()}</option>";
//        }
//        
//
//
//        return $html;
//    }
}

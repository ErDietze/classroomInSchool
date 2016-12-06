<?php

class KlassenraumHTML {

    public static function buildTableContent($objects) {
        $html = "<tbody>";

        foreach ($objects['klassenraum'] as $pk => $sk) {
            $html .= "
            <tr>
                <td>{$sk->getNummer()}</td>
                    <td>{$sk->getName()}</td>
                        <td>{$sk->getTafel_id()}</td>
                    <td><input type='checkbox' name='ids[]' value='$pk' /></td> 
                    <td><a href='index.php?id=$pk&area=klassenraum&action=showUpdate'>bearbeiten</a></td>
            </tr>";
        }
        $html .= "</tbody>";
        return $html;
    }

    public static function buildDropdown($klassenraum, $schulklassen_idAlt = NULL) {

        $html = '';
        if (is_null($schulklassen_idAlt)) {
            $html .= "<option value='0'></option>";
            foreach ($klassenraum as $pk => $sk) {
                $html .= "<option value='$pk' >{$sk->getName()}</option>";
            }
        } else {

            $sk_id = $schulklassen_idAlt;

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

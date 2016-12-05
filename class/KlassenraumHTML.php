<?php

class KlassenraumHTML {

    public static function buildTableContent($objects) {
        $html = "<tbody>";
        foreach ($objects['klassenraum'] as $pk => $sk) {
            $html .= "
            <tr>
                <td>{$sk->getNummer()}</td>
                    <td>{$sk->getSchulklassen_id()}</td>
                        <td>{$sk->getTafel_id()}</td>
                    <td><input type='checkbox' name='ids[]' value='$pk' /></td> 
                    <td><a href='index.php?id=$pk&area=klassenraum&action=showUpdate'>bearbeiten</a></td>
            </tr>";
        }
        $html .= "</tbody>";
return $html;}}
    

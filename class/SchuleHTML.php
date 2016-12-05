<?php

class SchuleHTML {

    public static function buildTableContent($schulklassen) {

        $html = "<tbody>";
        foreach ($schulklassen as $sk) {
            foreach ($sk->getSchueler() as $pk => $schueler) {
                $html .= "
            <tr>
                <td>{$schueler->getVorname()}</td>
                <td>{$schueler->getNachname()}</td>
                <td>{$sk->getName()}</td>
                <td><input type='checkbox' name='ids[]' value='$pk' /></td> 
                <td><a href='index.php?id=$pk&area=schueler&action=showUpdate'>bearbeiten</a></td>   
            </tr>";
            }            
        }
        
        $html .= "</tbody>";
        return $html;
    }

}

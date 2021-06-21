<?php
class Utilerias {
    public static function toXML($data,$nameList="",$nameElement="") {
        $xml= "<$nameList>";
        foreach ($data as $row) {
            $xml.="<$nameElement>";
            foreach ($row as $k=>$v) {
                $xml = $xml . "<$k>$v</$k>";
            }
            $xml.="</$nameElement>";
        } 
        $xml.="</$nameList> ";
        return ($xml);
    }
}
?>
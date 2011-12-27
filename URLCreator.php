<?php

/**
 * Simpel HRO (www.hro.nl) rooster dingetje.
 * Copyright (C) 2008 Kevin van der Vlist
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * Kevin van der Vlist - kevin@kevinvandervlist.nl
 */

/**
 * Klasse die zorgt dat er URL's naar een rooster worden teruggegeven.
 * @author Kevin van der Vlist
 */
class URLCreator {

    private $htmlArray;
    private $volgorde;
    private $kwartaal;

    /**
     * Constructor. Vereist het kwartaal van de URL.
     * @param String $kwartaal Het kwartaal.
     * @param boolean $volgorde De volgorde.
     */

    function __construct($kwartaal, $volgorde) {
        $url= "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $kwartaal . "/frames/navbar.htm";
        $tempconn = fopen($url, "r");
        $html = file_get_contents($url);
        fclose($tempconn);
        $this->htmlArray = explode("\n",$html);
        $this->volgorde = $volgorde;
        $this->kwartaal = $kwartaal;
    }

    /**
     * Methode om een Roosterurl te krijgen van een Klas, Docent of Lokaal.
     * @param String $ond Het rooster, hoofdlettergevoelig.
     * @param String $week De week om op te zoeken. Deze week moet wel binnen het kwartaal vallen!
     */

    public function getRoosterFrom($ond, $week) {
	if(strlen($week) == 1) {
	    $week = "0" . $week;
	}
        $klaar = false;
        $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/";

        $var = $this->maakArray("var classes");
        if(count($var) > 2) {
            for($i = 0; $i < count($var); $i++) {
                if(strcmp($var[$i], $ond) == 0) {
                    $i++;
                    $i = $this->nulAppend($i);
                    if($this->volgorde) {
                        $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal . "/" . $week ."/c/c" . $i . ".htm";
                    } else {
                        $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal  . "/c/" . $week ."/c" . $i . ".htm";
                    }
                    $klaar = true;
                }
            }
        }

        if($klaar == false) {
            $var = $this->maakArray("var teachers");
            if(count($var) > 2) {
                for($i = 0; $i < count($var); $i++) {
                    if(strcmp($var[$i], $ond) == 0) {
                        $i++;
                        $i = $this->nulAppend($i);
                        if($this->volgorde) {
                            $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal . "/" . $week ."/t/t" . $i . ".htm";
                        } else {
                            $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal  . "/t/" . $week ."/t" . $i . ".htm";
                        }
                        $klaar = true;
                    }
                }
            }
        }

        if($klaar == false) {
            $var = $this->maakArray("var rooms");
            if(count($var) > 2) {
                for($i = 0; $i < count($var); $i++) {
                    if(strcmp($var[$i], $ond) == 0) {
                        $i++;
                        $i = $this->nulAppend($i);
                        if($this->volgorde) {
                            $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal . "/" . $week ."/r/r" . $i . ".htm";
                        } else {
                            $URL = "http://www.misc.hro.nl/roosterdienst/webroosters/AP/" . $this->kwartaal  . "/r/" . $week ."/r" . $i . ".htm";
                        }
                        $klaar = true;
                    }
                }
            }
        }
        return $URL;
    }

    /**
     * Methode die een array returnt waar alleen maar docenten, lokalen of klassen
     * in staan.
     * @param String $str De tekst waarop gezocht moet worden. (var classes etc).
     */

    private function maakArray($str) {
        $var = Array();
        for($i = 0; $i < count($this->htmlArray); $i++) {
            if(stristr($this->htmlArray[$i], $str) == NULL) {
                //Leeg
            } else {
                $w = 0;
                $aantal = 0;
                $z = 0;
                $buf;
                $j = mb_strlen($this->htmlArray[$i]);
                for ($k = 0; $k < $j; $k++) {
                    $char = mb_substr($this->htmlArray[$i], $k, 1);
                    if($char == '"') {
                        if($w == 1) {
                            //Woord bezig
                            $w = 0;
                            $var[$aantal] = $buf;
                            $aantal++;
                        } else {
                            $w = 1;
                        }
                    } else {
                        if($w == 1) {
                            //              echo $char;
                            $buf = $buf . $char;
                        } else {
                            //              echo "<BR>";
                            $buf = '';
                        }
                    }
                }
            }
        }
        return $var;
    }

    /**
     * Methode die zorgt dat een int naar een 5cijferige string word omgezet
     * @param int $v Het getal.
     */

    private function nulAppend($v, $n) {
        $var = sprintf("%d", $v);
        while(strlen($var) < 5) {
            $var = sprintf("%d%s", 0, $var);
        }
        return $var;
    }
}
?>
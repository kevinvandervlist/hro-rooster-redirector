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

$favArray = Array("TI4V","TI3M","OELEW","BROPJ","MANJP","STOLC","ABDMM","ZEELV","SITER","I.2.02");
// Note: Kwartaal is hardcoded. Lekker smerig.
$kwartaal = 'kw2';

$normaal = true;
/*
Normaal = true slaat op de volgende URL-stijl: /AP/kw{1-4}/{weekno}/{objectcode}/{objectcode}{5cijferigeCode}
False betekent: /AP/kw{1-4}/{objectcode}/{weekno}/{objectcode}{5cijferigeCode}
*/

if(!isset($_GET["rooster"])) {
  $_GET["rooster"] = "";
}
$rooster = $_GET["rooster"];

if(!isset($_GET["next"])) {
  $_GET["next"] = "";
}
$next = $_GET["next"];

$week = date("W");
$dag = date("N");
$tijd = date("Gi");

if($dag >= 6 OR $dag == 5 && $tijd >= 1900) {
    $week++;
}
if(strcmp($next, "true") == 0) {
    $week++;
}
?>

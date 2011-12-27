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

include 'hroroosterconfig.php';
echo "<center>";
for($i = 0; $i < count($favArray); $i++) {
    echo "<a href=\"hrorooster.php?rooster=$favArray[$i]\" target=\"_parent\">$favArray[$i]</a>";
    echo " ";
}
$vw = date("W");
$dag = date("N");
$tijd = date("Gi");

if($dag >= 6 OR $dag == 5 && $tijd >= 1900) {
    $vw++;
}
$vw++;
if(strcmp($week, $vw) != 0) {
    echo  "<a href=\"hrorooster.php?rooster=" . $rooster . "&next=true\" target=\"_parent\">Week " . ($week + 1) . "</a>";
}
echo "</center>";
?>

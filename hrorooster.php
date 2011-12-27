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

include("hroroosterconfig.php");
include("URLCreator.php");

$URLCreator = new URLCreator($kwartaal, $normaal);
$URL = $URLCreator->getRoosterFrom($rooster, $week);

echo "
<html>
<head>
<title>HRO AP RoosterPortal | Kevin van der Vlist</title>
</head>
<frameset rows=\"55,*\">
<frame src=\"hroroosternav.php?rooster=$rooster&next=$next\" name=\"navigatie\"/>
<frame src=\"$URL\" name=\"hoofdframe\"/>
</frameset>
</html>
";

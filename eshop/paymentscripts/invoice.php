<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2013 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: invoice.php
| Author: Joakim Falk (Domi)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Access Denied"); }

echo "<br /><div class='admin-message'>".$locale['ESHPI100']." ".$pdata['method']."  <br /> 
".$locale['ESHPI102']." ".$odata['oemail'].".</div>";

//clear the cart.
dbquery("DELETE FROM ".DB_ESHOP_CART." WHERE puid ='".$username."'");
?>
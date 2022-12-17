<table width="100%" height="150px" cellpadding="0" cellspacing="0" border="0">
<tr>
<td align="left"><img src="images/logo.gif" border="0"/></td>
<td align="right" colspan="7" valign="bottom" height="120px"></td>
</tr>
<tr>
<td align="center" width="250px"><a href="index.php" class="link1"><img src="images/b_home1.jpg" border="0" hspace="2" />Inicio</a>
&nbsp;&nbsp;&nbsp;
<?php if($_SESSION["tipo_u"]==1){ ?>
<a href="index.php?cont=historial_bus" class="link1"><img src="images/b_print1.jpg" border="0" hspace="2" />Reportes</a>
&nbsp;&nbsp;&nbsp;
<?php } ?>
<a href="security/cerrar_sesion.php" class="link1"><img src="images/s_loggoff1.jpg" border="0" hspace="2"/>Salir</a></td>
<td align="center" height="30px"><script language="JavaScript" type="text/javascript">MostrarFecha();</script></td>
<td align="center">|</td>
<td align="center"><script type="text/javascript">inicio()</script></td>
<?php if($_SESSION["tipo_u"]!=""){ ?>
<td align="center">|</td>
<td align="center"><img src="images/user_suit.png" border="0" align="absmiddle"/>&nbsp;<?php echo $_SESSION["nombre"] ?></td>
<td align="center">|</td>
<td align="center"><img src="images/asterisk_yellow.png" border="0" align="absmiddle"/>&nbsp;<?php echo tipo_u($_SESSION["tipo_u"]) ?></td>
<?php } ?>
</tr>
</table>

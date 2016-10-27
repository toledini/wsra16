<?xml version="1.0" encoding ="ISO-8859-1"?>
<xsl:stylesheet version= "1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
<body>
	<table>
		<thead>
			<tr><th>Galdera</th><th>Zailtasuna</th><th>Gaia</th></tr>
		</thead>
	<xsl:for-each select ="/assessmentItems/assessmentItem">
		<tr>
			<td> <FONT SIZE="2">
				<xsl:value-of select ="itemBody/p"/><BR/>
			</FONT></td>
			
			<td><FONT SIZE="2">
				<xsl:value-of select ="@complexity"/><BR/>
			</FONT></td>
		
			<td><FONT SIZE="2">
				<xsl:value-of select ="@subject"/><BR/>
			</FONT></td>
		</tr>
	</xsl:for-each>
	</table>
			<p><a href = 'layout.html'>Goazen hasierako orrira.</a></p>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
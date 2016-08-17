<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:key name="keylist" match="element" use="author"/>
<xsl:key name="keylist" match="element" use="editor"/>
<xsl:key name="keylist" match="element" use="date"/>
<xsl:key name="keylist" match="element" use="title"/>
<xsl:template match="/">

<html>
<head>
        <link href="22.css" rel="stylesheet" type="text/css" />
    </head>
	<body>
		<h2>A Bibliography</h2>
		<div class="content">
			<xsl:for-each select="key('keylist', 'Prentice Hall')">
			<xsl:sort select="author"/>
			<p>
				<hr/>
				<ul class="lista">
				<li>Title:
				<xsl:value-of select="title"/></li>
				<li>
				Author:
				<xsl:value-of select="author"/>
				</li>
				<li>
				Date:
				<xsl:value-of select="date"/>
				</li>
				<li>
				Edtitor:
				<xsl:value-of select="editor"/></li>
				</ul>
				<br/>		
			</p>
			</xsl:for-each>
		</div>
	</body>
</html>

</xsl:template>
</xsl:stylesheet>

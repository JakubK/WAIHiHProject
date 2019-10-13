<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
    <html>
        <head>
            <meta charset="UTF-8"/>
        </head>
        <body>
            <xsl:apply-templates/>            
        </body>
    </html>
</xsl:template>

<xsl:template match="/projects">
    <xsl:for-each select="project">
        <xsl:sort select="name"/>
        <xsl:apply-templates select="."/>            
    </xsl:for-each>      
</xsl:template>

<xsl:template match="name">     
        <strong><xsl:value-of select="."/></strong>
</xsl:template>

<xsl:template match="source">
        <p><xsl:value-of select="."/></p>
</xsl:template>

<xsl:template match="description">
        <br/><xsl:value-of select="."/>
</xsl:template>

<xsl:template match="technologies">
    <ul>          
        <xsl:for-each select="technology">
            <li><xsl:value-of select=" . "/></li>
        </xsl:for-each>
    </ul>
</xsl:template>
</xsl:stylesheet>
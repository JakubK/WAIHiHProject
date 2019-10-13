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
    <table>
        <thead>
            <th>Nazwa</th>
            <th>Źródło</th>
            <th>Opis</th>
            <th>Technologie</th>
        </thead>
        <tbody>
            <xsl:for-each select="project">
                <xsl:sort select="name"/>
                <tr>
                    <xsl:apply-templates select="."/>            
                </tr>
            </xsl:for-each>
        </tbody>
    </table>
</xsl:template>

<xsl:template match="name">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>

<xsl:template match="source">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>

<xsl:template match="description">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>

<xsl:template match="technologies">
    <td>          
        <xsl:for-each select="technology">
            <xsl:value-of select=" . "/>,  
        </xsl:for-each>
    </td>
</xsl:template>
</xsl:stylesheet>
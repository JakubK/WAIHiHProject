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
            <th>Opis</th>
            <th>Data wydania</th>
            <th>Technologie</th>
        </thead>
        <tbody>
            <xsl:for-each select="project">
                <xsl:sort select="title"/>
                <tr>
                    <xsl:apply-templates select="."/>
                </tr>
            </xsl:for-each>
        </tbody>
    </table>
</xsl:template>

<xsl:template match="title">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>


<xsl:template match="description">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>

<xsl:template match="releaseDate">
    <td>          
        <xsl:value-of select="."/>
    </td>
</xsl:template>

<xsl:template match="technologies">
    <xsl:if test="not(../releaseDate)">
        <td>
            -
        </td>
    </xsl:if>
    <td>          
        <xsl:for-each select="technology">
            <xsl:value-of select="name"/>,  
        </xsl:for-each>
    </td>
</xsl:template>
</xsl:stylesheet>
<?xml version="1.0" encoding="windows-1251"?> 
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/fo/docbook.xsl"/>
<xsl:param name="chunker.output.encoding" select="'windows-1251'"/>

<xsl:param name="paper.type" select="'A4'"/>
<xsl:param name="double.sided" select="'1'"/>
<xsl:param name="fop.extensions" select="'1'"/>
<xsl:param name="body.font.family" select="'Arial'"/>
<xsl:param name="title.font.family" select="'Arial'"/>
<xsl:param name="monospace.font.family" select="'Arial'"/>

<xsl:template name="initial.page.number">auto-odd</xsl:template>
<xsl:template name="page.number.format">1</xsl:template>

<xsl:attribute-set name="monospace.verbatim.properties">
    <xsl:attribute name="wrap-option">wrap</xsl:attribute>
</xsl:attribute-set>

<xsl:param name="shade.verbatim" select="1"/>

<xsl:attribute-set name="shade.verbatim.style">
  <xsl:attribute name="background-color">#E0E0E0</xsl:attribute>
  <xsl:attribute name="border-width">0.5pt</xsl:attribute>
  <xsl:attribute name="border-style">solid</xsl:attribute>
  <xsl:attribute name="border-color">#575757</xsl:attribute>
  <xsl:attribute name="padding">3pt</xsl:attribute>
</xsl:attribute-set>

</xsl:stylesheet>
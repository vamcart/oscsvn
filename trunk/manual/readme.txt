
������������� HTML:

xsltproc --nonet --stringparam chunker.output.encoding windows-1251 \
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/html/chunk.xsl index.xml

��� ����� � ����� �����:
xsltproc --nonet --stringparam chunker.output.encoding windows-1251 \
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/html/onechunk.xsl index.xml

����� � ������� HTML-Help ��� ����������� ���������� � CHM (Windows Help).
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/htmlhelp/htmlhelp.xsl index.xml

hhc.exe project.hhp

�������� PDF:

1. �������� fo ����� � �������� /home/work/My/docbook/book:

xsltproc --nonet pdf.xsl index.xml >index.fo

������ PDF � fop:

/usr/local/fop/fop.sh -fo index.fo -pdf index.pdf -c /usr/local/fop/conf/userconfig.xml

fop 0.9 - /usr/local/fop1/fop -fo index.fo -pdf index.pdf -c /usr/local/fop/conf/userconfig.xml

��������� ������ java:
XEP: /home/vam/XEP/xep:
"$JAVA_HOME/bin/java" -Xmx500000000 \

FOP: /usr/local/fop/fop.sh:
$JAVACMD -Xmx500000000 -classpath "$LOCALCLASSPATH" $FOP_OPTS org.apache.fop.apps.Fop "$@"

��������� ������� �� ttf � xml!

���������� ������� (��������� � �������� � fop):
java -cp build/fop.jar:lib/batik.jar:lib/xalan-2.0.0.jar:lib/xerces.jar:lib/jimi-1.0.jar org.apache.fop.fonts.apps.TTFReader arial.ttf arial.xml

��������� jimi ��� ��������� tiff � docbook.
������������� JimiProClasses.zip � jimi-1.0.jar � ����������� � /usr/local/fop/lib

2. ������ pdf � XEP:

/home/vam/XEP/xep index.fo

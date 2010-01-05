
Генерирование HTML:

xsltproc --nonet --stringparam chunker.output.encoding windows-1251 \
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/html/chunk.xsl index.xml

Вся книга в одном файле:
xsltproc --nonet --stringparam chunker.output.encoding windows-1251 \
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/html/onechunk.xsl index.xml

Книга в формате HTML-Help для последующей компиляции в CHM (Windows Help).
/usr/share/sgml/docbook/xsl-stylesheets-1.68.1-1.1/htmlhelp/htmlhelp.xsl index.xml

hhc.exe project.hhp

Создание PDF:

1. Создание fo файла в каталоге /home/work/My/docbook/book:

xsltproc --nonet pdf.xsl index.xml >index.fo

Создаём PDF в fop:

/usr/local/fop/fop.sh -fo index.fo -pdf index.pdf -c /usr/local/fop/conf/userconfig.xml

fop 0.9 - /usr/local/fop1/fop -fo index.fo -pdf index.pdf -c /usr/local/fop/conf/userconfig.xml

Добавляем память java:
XEP: /home/vam/XEP/xep:
"$JAVA_HOME/bin/java" -Xmx500000000 \

FOP: /usr/local/fop/fop.sh:
$JAVACMD -Xmx500000000 -classpath "$LOCALCLASSPATH" $FOP_OPTS org.apache.fop.apps.Fop "$@"

Генерация шрифтов из ttf в xml!

Правильный вариант (запускать в каталоге с fop):
java -cp build/fop.jar:lib/batik.jar:lib/xalan-2.0.0.jar:lib/xerces.jar:lib/jimi-1.0.jar org.apache.fop.fonts.apps.TTFReader arial.ttf arial.xml

Установка jimi для поддержки tiff в docbook.
Переименовать JimiProClasses.zip в jimi-1.0.jar и скопировать в /usr/local/fop/lib

2. Создаём pdf в XEP:

/home/vam/XEP/xep index.fo

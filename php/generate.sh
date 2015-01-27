#!/bin/sh

host="localhost"
db="akbi"
usr="root"
pwd="mysql"

echo "drop database if exists akbi; create database akbi  DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;" | /usr/bin/mysql -uroot -pmysql

perl author_sakshi.pl $host $db $usr $pwd
perl author_samvada.pl $host $db $usr $pwd
perl author_maatukate.pl $host $db $usr $pwd
perl author_pp.pl $host $db $usr $pwd

perl feat_sakshi.pl $host $db $usr $pwd
perl feat_samvada.pl $host $db $usr $pwd
perl feat_maatukate.pl $host $db $usr $pwd
perl feat_pp.pl $host $db $usr $pwd

perl articles_sakshi.pl $host $db $usr $pwd
perl articles_samvada.pl $host $db $usr $pwd
perl articles_maatukate.pl $host $db $usr $pwd
perl articles_pp.pl $host $db $usr $pwd

#~ perl ocr.pl $host $db $usr $pwd
#~ perl searchtable.pl $host $db $usr $pwd
#~ echo "create fulltext index text_index_records on searchtable (text);" | /usr/bin/mysql -uroot -pmysql vk

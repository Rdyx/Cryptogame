#!/bin/bash
echo "Commencement du script..."
#/home/cryptogame/.local/bin/scrapy runspider /home/cryptogame/www/python/crawlerCMC.py -s FEED_EXPORT_ENCODING=utf-8 -o /home/cryptogame/www/python/currencies.json
echo "update json fini"
/usr/bin/python /home/cryptogame/www/python/pushDB.py
echo "update db fini"
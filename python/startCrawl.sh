#!/bin/bash
cd /home/cryptogame/www/python
echo "Commencement du script..."
scrapy runspider crawlerCMC.py -s FEED_EXPORT_ENCODING=utf-8 -o currencies.json
echo "update json fini"
python pushDB.py
echo "update db fini"
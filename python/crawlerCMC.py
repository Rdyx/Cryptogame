#scrapy runspider crawlerCMC.py -s FEED_EXPORT_ENCODING=utf-8 -o currencies.json
f = open('currencies.json', 'w')
f.close()

import scrapy

class QuotesSpider(scrapy.Spider):
    name = "quotes"
    start_urls = [
        'https://coinmarketcap.com/all/views/all/',
    ]

    def parse(self, response):
        for link in response.css('table#currencies-all tbody tr'):
            yield {
                'currencieURL' : link.css('td.currency-name span a ::attr(href)').extract_first(),
                'currencieName' : link.css('td.currency-name a.currency-name-container ::text').extract_first(),
                'currencieShortName' : link.css('td.col-symbol ::text').extract_first(),
                'currencieMarketCap' : link.css('td.market-cap ::text').re_first(r'\s*(.*)'),
                'currencieFIATValue' : link.css('td.text-right a.price ::text').extract_first(),
                'currencieCirculatingSupply' : link.css('td.circulating-supply a ::text').re_first(r'\s*(.*)'),
                'currencieVolume' : link.css('td.text-right a.volume ::text').extract_first(),
                'currencieLastHour' : link.css('td.percent-1h ::text').extract_first(),
                'currencieLast24Hour' : link.css('td.percent-24h ::text').extract_first(),
                'currencieLast7Days' : link.css('td.percent-7d ::text').extract_first(),
                }
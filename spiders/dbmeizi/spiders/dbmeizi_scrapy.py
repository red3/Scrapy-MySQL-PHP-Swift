from scrapy import Spider
from scrapy.selector import Selector
from dbmeizi.items import DbmeiziItem
import time

class dbmeiziSpider(Spider):
    name = "dbmeiziSpider"
    allowed_domin =["dbmeinv.com"]
    strArray = []
    for i in range(1, 3, 1):
        str = "http://www.dbmeinv.com/?pager_offset=%d" % i
        strArray.append(str)
    start_urls = strArray
            
    def parse(self, response):
        divResults = Selector(response).xpath('//div[@class="img_single"]')
        for div in divResults:
            href = div.xpath('.//a')[0]
            img = div.xpath('.//img')[0]

            item = DbmeiziItem()
            item['topic_link'] = href.xpath('@href').extract()[0]
            item['title'] = img.xpath('@title').extract()[0] 
            item['imgsrc'] = img.xpath('@src').extract()[0]
            item['star_count'] = 0
            item['update_time'] = time.time()
            yield item
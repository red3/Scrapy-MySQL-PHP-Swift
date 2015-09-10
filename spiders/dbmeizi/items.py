# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class DbmeiziItem(scrapy.Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    imgsrc = scrapy.Field()
    title = scrapy.Field()
    topic_link = scrapy.Field()
    star_count = scrapy.Field()
    update_time = scrapy.Field()
    pass

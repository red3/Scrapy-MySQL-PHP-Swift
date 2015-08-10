# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

from scrapy.item import Item, Field


class MeiziItem(Item):
    # define the fields for your item here like:
    # name = scrapy.Field()
    imgsrc = Field()
    title = Field()
    topic_link = Field()
    star_count = Field()
    update_time = Field()

# -*- coding: utf-8 -*-

# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: http://doc.scrapy.org/en/latest/topics/item-pipeline.html

import scrapy
import MySQLdb
import MySQLdb.cursors
from twisted.enterprise import adbapi

class DbmeiziPipeline(object):
    def __init__(self, dbpool):
	   self.dbpool = dbpool

    @classmethod
    def from_settings(cls, settings):
	   dbargs = dict(
		  host = settings['MYSQL_HOST'],
		  db = settings['MYSQL_DBNAME'],
		  port = settings['MYSQL_PORT'],
		  user = settings['MYSQL_USER'],
		  passwd = settings['MYSQL_PASSWD'],
		  charset = 'utf8',
		  cursorclass = MySQLdb.cursors.DictCursor,
		  use_unicode = True,
		)
	   dbpool = adbapi.ConnectionPool('MySQLdb', **dbargs)
	   return cls(dbpool)

    #pipeline默认调用
    def process_item(self, item, spider):
        d = self.dbpool.runInteraction(self._do_upinsert, item, spider)  
    	return item
    #将每行更新或写入数据库中
    def _do_upinsert(self, conn, item, spider):                 

    	valid = True
    	for data in item:
    		if not data:
    			valid = False
    			# raise DropItem("Missing {0}!".format(data))
    			# print "Missing data"
        if valid:
            result = conn.execute("""
                insert into meizi(title, imgsrc, topic_link, star_count, update_time) 
                values(%s, %s, %s, %s, %s)
                """, (item['title'], item['imgsrc'], item['topic_link'], item['star_count'], item['update_time']))
            if result:
                print "added a girl into db"
            else:
                print "failed insert into meizi"
import pymongo
from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector

from scrawer.items import ShoeBrand 
from scrawer.items import JdShoe



class shoeSpider(BaseSpider):
    name = "test"
    allowed_domains = ["jd.com"]
    
    start_urls = [ "http://list.jd.com/1315-1344-9754-288552-0-0-0-0-0-0-1-1-1-1.html" ]

 
    def parse(self, response):
        
        hxs = HtmlXPathSelector(response)
        sites = hxs.select('//div[@id="plist"]/ul[@class="list-h"]')
        items = []

        for site in sites:
            item = JdShoe()
            item['title']   = site.select('li/div[@class="p-name"]/a/text()').extract()
            item['buyurl']  = site.select('li/div[@class="p-name"]/a/@href').extract()
            item['price']   = site.select('li/div//strong/text()').extract()
            item['imgurl']  = site.select('li/div/a/img/@src').extract()
            items.append(item)

        return items

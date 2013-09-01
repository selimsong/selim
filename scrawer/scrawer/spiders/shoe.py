import pymongo
from scrapy.spider import BaseSpider
from scrapy.selector import HtmlXPathSelector

from scrawer.items import ShoeBrand 
from scrawer.items import JdShoe
from scrawer.items import JdShoeOrder

class shoePagination(BaseSpider):
    name = "shoepagination"
    allowed_domains = ["jd.com"]

    def __init__(self, domain=''):
           self.start_urls = [ domain]

    def parse(self, response):

        hxs = HtmlXPathSelector(response)
        sites = hxs.select('//div[@class="pagin fr"]')
        items = []

        for site in sites:
            item = JdShoeOrder()
            item['title']    = site.select('a/text()').extract()
            item['orderurl']  = site.select('a/@href').extract()
            items.append(item)

        return items



class shoeOrder(BaseSpider):
    name = "shoeorder"
    allowed_domains = ["jd.com"]

    def __init__(self, domain=''):
           self.start_urls = [ domain]

    def parse(self, response):

        hxs = HtmlXPathSelector(response)
        sites = hxs.select('//div[@class="fore1"]/dl[@class="order"]')
        items = []

        for site in sites:
            item = JdShoeOrder()
            item['title']    = site.select('dd/a/text()').extract()
            item['orderurl']  = site.select('dd/a/@href').extract()
            items.append(item)

        return items




class shoeSpider(BaseSpider):
    name = "shoe"
    allowed_domains = ["jd.com"]
    
    def __init__(self, domain=''):
           self.start_urls = [ domain]
 
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
            item['imgurlLazy']  = site.select('li/div/a/img/@data-lazyload').extract()
            items.append(item)

        return items




class BrandSpider(BaseSpider):
    name = "brand"
    allowed_domains = ["jd.com"]
    start_urls = [
        "http://list.jd.com/1315-1344-9754.html"
    ]

    def parse(self, response):
        hxs = HtmlXPathSelector(response)
        sites = hxs.select('//div[@class="content"]/div')
        items = []

        for site in sites:
            item = ShoeBrand()
            item['title'] = site.select('a/text()').extract()
            item['link'] = site.select('a/@href').extract()
            items.append(item)

        return items


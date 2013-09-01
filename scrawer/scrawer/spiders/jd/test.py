#!/usr/bin/python

import pymongo


try:
    connection = pymongo.Connection('mongodb://localhost:27017')
    database  = connection['spider']
except:
    print('Error: unable to connect to database')
    connection = None

if connection is not None:
  
   brands = database.brands.find({'weight':2})
   brandlist = []
   if  brands.count() > 0:
      for brand in brands:
        brandlist.append(brand['link']) 
print brandlist        

# print('%s  url  %s  '     % ( brand['title'], brand['link'] ))

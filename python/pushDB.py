# python pushDB.py
import json

currencies = json.load(open("currencies.json"))

i = 0

import sys
import mysql.connector
con = mysql.connector.connect(user='root',password='admin',host='localhost', port='8081',database='cryptogame')
cur = con.cursor(buffered=True)

def existsOrNot(arg1):
    test = cur.execute("SELECT cry_fullName FROM cryptos WHERE cry_fullName = %s", ("" + arg1 + "",))
    if cur.rowcount:
        exists = cur.fetchone()[0]
        return exists
    else:
        return -1

try:
    while i < len(currencies):
        currencieURL = 'https://coinmarketcap.com/' + currencies[i]['currencieURL']
        currencieName = currencies[i]['currencieName']
        currencieShortName = currencies[i]['currencieShortName']
        
        currencieMarketCap = currencies[i]['currencieMarketCap']
        currencieFIATValue = currencies[i]['currencieFIATValue']
        currencieCirculatingSupply = currencies[i]['currencieCirculatingSupply']
        currencieVolume = currencies[i]['currencieVolume']
        currencieLastHour = currencies[i]['currencieLastHour']
        currencieLast24Hour = currencies[i]['currencieLast24Hour']
        currencieLast7Days = currencies[i]['currencieLast7Days']
        id = existsOrNot(currencieName);
        if id == -1:
            cur.execute("""INSERT INTO cryptos 
                (cry_url,
                cry_name,
                cry_fullName,
                cry_last7Days,
                cry_last24Hours,
                cry_lastHour,
                cry_volume,
                cry_supply,
                cry_fiatValue,
                cry_marketcap) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""",
                (currencieURL,
                currencieShortName,
                currencieName,
                currencieLast7Days,
                currencieLast24Hour,
                currencieLastHour,
                currencieVolume,
                currencieCirculatingSupply,
                currencieFIATValue,
                currencieMarketCap))
        else:
            cur.execute("""UPDATE cryptos SET
                cry_url = %s,
                cry_name = %s,
                cry_fullName = %s,
                cry_last7Days = %s,
                cry_last24Hours = %s,
                cry_lastHour = %s,
                cry_volume = %s,
                cry_supply = %s,
                cry_fiatValue = %s,
                cry_marketcap = %s
                WHERE cry_fullName = %s""",
                (currencieURL,
                currencieShortName,
                currencieName,
                currencieLast7Days,
                currencieLast24Hour,
                currencieLastHour,
                currencieVolume,
                currencieCirculatingSupply,
                currencieFIATValue,
                currencieMarketCap,
                currencieName))
        con.commit()
        i += 1
    print ("Database successfully updated")
# {"currencieURL": "/currencies/bitcoin/", 
# "currencieName": "Bitcoin", 
# "currencieShortName": "BTC", 
# "currencieMarketCap": "$272,794,271,751", 
# "currencieFIATValue": "$16272.20", 
# "currencieCirculatingSupply": "16,764,437", 
# "currencieVolume": "$13,441,400,000", 
# "currencieLastHour": "-0.46%", 
# "currencieLast24Hour": "15.95%", 
# "currencieLast7Days": "-8.28%"},
# create table cryptos
# (
# 	cry_id int(10) unsigned auto_increment
# 		primary key,
# cry_url, cry_name, cry_fullName, cry_last7Days, cry_last24Hours, cry_lastHour, cry_volume, cry_supply, cry_fiatValue, cry_marketcap
# ;


except:
    print(sys.exc_info()[0])
    raise
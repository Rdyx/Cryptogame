# python pushDB.py
import json

currencies = json.load(open("/home/cryptogame/www/python/currencies.json"))


import sys
import mysql.connector
import datetime
con = mysql.connector.connect(user='150019',password='topkek',host='mysql-cryptogame.alwaysdata.net', port='3306',database='cryptogame_cryptogame')
cur = con.cursor(buffered=True)
i = 0

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
        currencieBTCValue = currencies[i]['currencieBTCValue']
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
                cry_btcValue,
                cry_marketcap) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""",
                (currencieURL,
                currencieShortName,
                currencieName,
                currencieLast7Days,
                currencieLast24Hour,
                currencieLastHour,
                currencieVolume,
                currencieCirculatingSupply,
                currencieFIATValue,
                currencieBTCValue,
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
                cry_btcValue = %s,
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
                currencieBTCValue,
                currencieMarketCap,
                currencieName))
        date = datetime.datetime.now()
        minute = date.minute
        hour = date.hour
        day = date.day
        month = date.month
        if minute < 10:
            minute = '0'+str(date.minute)
        if hour < 10:
            hour = '0'+str(date.month)
        if day < 10:
            day = '0'+str(date.day)
        if month < 10:
            month = '0'+str(date.month)
        dateNow = str(hour) + ':' + str(minute) + ' ' + str(day) + '/' + str(month) + '/' + str(date.year)
        cur.execute("UPDATE compteur SET last_update = '"+dateNow+"'")
        con.commit()
        i += 1
    print ("Database successfully updated")

except:
    print(sys.exc_info()[0])
    raise
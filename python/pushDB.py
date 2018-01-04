# python pushDB.py
import json
# /home/cryptogame/www/python/
currencies = json.load(open("/home/cryptogame/www/python/currencies.json"))

import sys
import mysql.connector
import datetime
from datetime import date, timedelta
con = mysql.connector.connect(user='*',password='*',host='mysql-cryptogame.alwaysdata.net', port='3306',database='cryptogame_cryptogame')
cur = con.cursor(buffered=True)
i = 0
j = 0

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
        i += 1
    
    date = datetime.datetime.now()
    minute = date.minute
    hour = date.hour
    day = date.day
    month = date.month
    if minute < 10:
        minute = '0'+str(date.minute)
    if hour < 10:
        hour = '0'+str(date.hour)
    if day < 10:
        day = '0'+str(date.day)
    if month < 10:
        month = '0'+str(date.month)

    dateNow = str(hour) + ':' + str(minute) + ' ' + str(day) + '/' + str(month) + '/' + str(date.year)
    cur.execute("UPDATE compteur SET last_update = '"+dateNow+"'")

    dateDBCompare = str(date.year)+str(month)+str(day)+str(hour)+str(minute)
    cur.execute ("SELECT top_endDate, top_id FROM topCall WHERE top_status = 'En cours'")
    getCallEndDate = cur.fetchall()
    while j < len(getCallEndDate):
        if int(getCallEndDate[j][0]) < int(dateDBCompare):
            cur.execute("SELECT top_target, cryptos.cry_btcValue FROM topCall JOIN cryptos on topCall.cry_id = cryptos.cry_id WHERE topCall.cry_id = cryptos.cry_id AND top_id = '"+str(getCallEndDate[j][1])+"'")
            comparaisonTargetCurrent = cur.fetchall()
            print('target ' + comparaisonTargetCurrent[0][0])
            print('Current ' +comparaisonTargetCurrent[0][1])
            if float(comparaisonTargetCurrent[0][0]) > float(comparaisonTargetCurrent[0][1]):
                print('only total')
                cur.execute ("UPDATE topCall JOIN cry_users ON topCall.usr_id = cry_users.usr_id SET top_status = 'Fini', cry_users.usr_totalCallNumber = cry_users.usr_totalCallNumber+1 WHERE top_id = '"+str(getCallEndDate[j][1])+"' AND topCall.usr_id = cry_users.usr_id")
            else:
                print('total and success')
                cur.execute ("UPDATE topCall JOIN cry_users ON topCall.usr_id = cry_users.usr_id SET top_status = 'Fini', cry_users.usr_totalCallNumber = cry_users.usr_totalCallNumber+1, cry_users.usr_SuccessCall = cry_users.usr_SuccessCall+1 WHERE top_id = '"+str(getCallEndDate[j][1])+"' AND topCall.usr_id = cry_users.usr_id")
        j += 1
    
    con.commit()
    print ("Database successfully updated")

except:
    print(sys.exc_info()[0])
    raise
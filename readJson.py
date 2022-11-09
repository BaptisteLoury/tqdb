import json
import re
import psycopg2
from psycopg2 import Error
import ressources
import time

def connectDB():
    return psycopg2.connect(user="tqdb",
    password="tqdb",
    host="localhost",
    database="titanquest"
    )

def loadDataFromJson():
    f = open('tqdb.fr.1.4.0.json')
    return json.load(f)




############################################################################################################
#                                               RESET TABLES                                               #
############################################################################################################
def resetTables(cursor):
    deleteQuery = """DELETE FROM MAIN.ITEMPROPERTY;
    DELETE FROM MAIN.CHANCEOF;
    DELETE FROM MAIN.PROPERTY;
    DELETE FROM MAIN.ITEM;
    DELETE FROM MAIN.CLASSIFICATION;
    DELETE FROM MAIN.ITEM_TYPE;
    ALTER SEQUENCE MAIN.classification_class_id_seq RESTART WITH 1;
    ALTER SEQUENCE MAIN.property_prop_id_seq RESTART WITH 1;
    ALTER SEQUENCE MAIN.item_item_id_seq RESTART WITH 1;
    ALTER SEQUENCE MAIN.item_type_ityp_id_seq RESTART WITH 1;
    ALTER SEQUENCE MAIN.chanceof_chanceof_id_seq RESTART WITH 1;
    """
    cursor.execute(deleteQuery)





############################################################################################################
#                                               INSERT TYPE                                                #
############################################################################################################
def insertItemType(data,cursor):
    print("### Inserting item type")
    allType = []
    for itemType in data['equipment']:
        if itemType not in allType:
            allType.append(itemType)
    query = """INSERT INTO MAIN.ITEM_TYPE(ityp_name) VALUES\n"""
    i = 0
    for typ in allType:
        i+=1
        t = ressources.switch.get(typ, "invalid")
        if t != "invalid":
            query += f"""('{t[0]}')"""
            if i < len(allType):
                query += """,\n"""
        
    query += """;"""
    cursor.execute(query)
    print("Insert successful")





############################################################################################################
#                                          INSERT CLASSIFICATIONS                                          #
############################################################################################################
def insertClassification(data,cursor):
    print("### Inserting item classification")
    allClass = []
    for itemType in data['equipment']:
        for items in data['equipment'][itemType]:
            if items['classification'] not in allClass:
                allClass.append(items['classification'])
    query = """INSERT INTO MAIN.CLASSIFICATION(class_name) VALUES\n"""
    i = 0
    for clas in allClass:
        query += f"""('{clas}')"""
        i+=1
        if i < len(allClass):
            query += """,\n"""
        
    query += """;"""
    cursor.execute(query)
    print("Insert successful")




############################################################################################################
#                                             INSERT PROPERTIES                                            #
############################################################################################################
def insertProperties(data,cursor):
    print("### Inserting properties")
    p = r'[-+]?\d*\.\d+|[-+]?\d+'
    allProperties = []
    for itemType in data["equipment"]:
        for item in data["equipment"][itemType]:
            # Every items
            if 'properties' in item:
                for proprty in item['properties']:
                    if type(proprty) is str:
                        # All items but Charms and Relics
                        if type(item['properties'][proprty]) is str:
                            # Simple properties
                            values = re.findall(p, item["properties"][proprty])
                            ppty = re.sub(p, "€€", item["properties"][proprty])
                            if (proprty,ppty) not in allProperties:
                                allProperties.append((proprty,ppty))
                        else:
                            if type(item['properties'][proprty]) is list:
                                # Racial bonus
                                for pp in item['properties'][proprty]:
                                    if type(pp) is str:
                                        ppty = re.sub(p, "€€", pp)
                                        if (proprty,ppty) not in allProperties:
                                            allProperties.append((proprty,ppty))
                                    else:
                                        # When multi racial bonus
                                        for pq in pp:
                                            ppty = re.sub(p, "€€", pq)
                                            if (proprty,ppty) not in allProperties:
                                                allProperties.append((proprty,ppty))
                                                
                            else:
                                if 'chance' in item['properties'][proprty]:
                                    # Properties with triggering chance
                                    for pp in item['properties'][proprty]['properties']:
                                        ppty = re.sub(p, "€€", item['properties'][proprty]['properties'][pp])
                                        if (pp,ppty) not in allProperties:
                                            allProperties.append((pp,ppty))

                                elif proprty == 'petBonus':
                                    # Properties that are pet bonus
                                    for pp in item['properties'][proprty]:
                                        ppty = re.sub(p, "€€", item['properties'][proprty][pp])
                                        if (pp,ppty) not in allProperties:
                                            allProperties.append((pp,ppty))

                                # elif 'level' in item['properties'][proprty]:
                                #     # Properties that grant spells
                                #     print()

                                # else:
                                #     # Properties that augment skills
                                #     print()
                    else:
                        # Charms and Relics only
                        for pp in item['properties'][0]:
                            if type(item['properties'][0][pp]) is str:
                                # Simple properties
                                ppty = re.sub(p, "€€", item['properties'][0][pp])
                                if (pp,ppty) not in allProperties:
                                    allProperties.append((pp,ppty))
                            else:
                                # Properties with triggering chance
                                for qp in item['properties'][0][pp]['properties']:
                                    ppty = re.sub(p, "€€", item['properties'][0][pp]['properties'][qp])
                                    if (qp,ppty) not in allProperties:
                                        allProperties.append((qp,ppty))

            # Charms, Relics and Artifact Formulas only
            if 'bonus' in item:
                for bonus in item['bonus']:
                    for proprty in bonus['option']:
                        if type(proprty) is str:
                            if type(bonus['option'][proprty]) is str:
                                ppty = re.sub(p, "€€", bonus['option'][proprty])
                                if (proprty,ppty) not in allProperties:
                                    allProperties.append((proprty,ppty))
                            else:
                                # pet bonus
                                if proprty == 'petBonus':
                                    for pp in bonus['option'][proprty]:
                                        ppty = re.sub(p, "€€", bonus['option'][proprty][pp])
                                        if (pp,ppty) not in allProperties:
                                            allProperties.append((pp,ppty))
                                # racial bonuses
                                else:
                                    for pp in bonus['option'][proprty]:
                                        ppty = re.sub(p, "€€", pp)
                                        if (proprty,ppty) not in allProperties:
                                            allProperties.append((proprty,ppty))


    for pp in allProperties:
        query = """INSERT INTO MAIN.PROPERTY(prop_tag,prop_name_fr,prop_nb_variable) VALUES(%s,%s,%s)"""
        cursor.execute(query, (pp[0],pp[1],pp[1].count("€€")))

    print("Insert successful")




############################################################################################################
#                                               INSERT ITEMS                                               #
############################################################################################################
def insertItems(data,cursor):
    print("### Inserting items")
    p = r'[-+]?\d*\.\d+|[-+]?\d+'
    
    for itemType in data["equipment"]:
        print("# Inserting",ressources.switch.get(itemType,"Unknown type"))
        for item in data["equipment"][itemType]:

            # inserting basic item parameters
            insertParameters = """INSERT INTO MAIN.ITEM(item_tag,item_req_lvl,class_id,ityp_id,item_name,item_req_str,item_req_int,item_req_dex)
            VALUES(%s,%s,
            (SELECT class_id FROM MAIN.CLASSIFICATION WHERE class_name = %s),
            (SELECT ityp_id FROM MAIN.ITEM_TYPE WHERE ityp_name = %s),
            %s, %s, %s, %s) RETURNING item_id;"""
            cursor.execute(insertParameters, 
            (item['tag'],
            item['levelRequirement'] if 'levelRequirement' in item else 0,
            item['classification'],
            ressources.switch.get(itemType,"Normal")[0],
            item['name'],
            item['intelligenceRequirement'] if 'intelligenceRequirement' in item else 0,
            item['dexterityRequirement'] if 'dexterityRequirement' in item else 0,
            item['strengthRequirement'] if 'strengthRequirement' in item else 0
            ))

            # inserting item properties
            iditem = cursor.fetchone()[0]
            allProperties = []
            if 'properties' in item: 
                for proprty in item['properties']:
                    if type(proprty) is str:
                        if type(item['properties'][proprty]) is str:
                            values = re.findall(p, item['properties'][proprty])
                            values = list(map(float, values))
                            ppty = re.sub(p, "€€", item['properties'][proprty])
                            ls = (values,proprty,ppty,bool(False),0)
                            allProperties.append(ls)
                        else:
                            # Racial Bonus
                            if type(item['properties'][proprty]) is list:
                                for pp in item['properties'][proprty]:
                                    if type(pp) is str:
                                        values = re.findall(p, pp)
                                        values = list(map(float, values))
                                        ppty = re.sub(p, "€€", pp)
                                        ls = (values,proprty,ppty,bool(False),0)
                                        allProperties.append(ls)
                                    else:
                                        # When multi racial bonus
                                        for pq in pp:
                                            values = re.findall(p, pq)
                                            values = list(map(float, values))
                                            ppty = re.sub(p, "€€", pq)
                                            ls = (values,proprty,ppty,bool(False),0)
                                            if ls not in allProperties:
                                                allProperties.append(ls)
                            else:
                                if proprty == 'petBonus':
                                    # Properties that are pet bonus
                                    for pp in item['properties'][proprty]:
                                        values = re.findall(p, item['properties'][proprty][pp])
                                        values = list(map(float, values))
                                        ppty = re.sub(p, "€€", item['properties'][proprty][pp])
                                        ls = (values,pp,ppty,bool(True),0)
                                        if ls not in allProperties:
                                            allProperties.append(ls)       

                                elif 'chance' in item['properties'][proprty]:
                                    # Properties with triggering chance

                                    chance_desc = item['properties'][proprty]['chance']
                                    percOfChance = re.findall(p, chance_desc)
                                    percOfChance = float(percOfChance[0]) if len(percOfChance) > 0 else 0

                                    # inserting in table chanceOf
                                    insertChanceOfQuery = """INSERT INTO MAIN.CHANCEOF(item_id, chanceof_perc, chanceof_desc,chanceof_is_bonus)
                                    VALUES(%s,%s,%s,FALSE) RETURNING chanceof_id;"""
                                    cursor.execute(insertChanceOfQuery, (iditem,percOfChance,chance_desc))
                                    idChanceOf = cursor.fetchone()[0]


                                    for pp in item['properties'][proprty]['properties']:
                                        values = re.findall(p, item['properties'][proprty]['properties'][pp])
                                        values = list(map(float, values))
                                        ppty = re.sub(p, "€€", item['properties'][proprty]['properties'][pp])
                                        ls = (values,pp,ppty,bool(False),idChanceOf)
                                        if ls not in allProperties:
                                            allProperties.append(ls)
                                        
                    # else:
                    #     # Charms and Relics only
                    #     for pp in item['properties'][0]:
                    #         if type(item['properties'][0][pp]) is str:
                    #             # Simple properties
                    #             print(item['properties'][0][pp])
                    #         else:
                    #             # Properties with triggering chance
                    #             for qp in item['properties'][0][pp]['properties']:
                    #                 (None)

            
            # Charms, Relics and Artifact Formulas only
            if 'bonus' in item:
                for bonus in item['bonus']:
                    for pp in bonus['option']:
                        if type(bonus['option'][pp]) is str:
                            values = re.findall(p, bonus['option'][pp])
                            values = list(map(float, values))
                            ppty = re.sub(p, "€€", bonus['option'][pp])
                            ls = (values,pp,ppty,bool(False),"",bonus['chance'])
                            # print(ls)
                            # allProperties.append(ls)
                        else:
                            (None)
                            # print(bonus['option'][pp])

            # Inserting all properties related to this item
            i = 0
            insertPropQuery = """INSERT INTO MAIN.ITEMPROPERTY(item_id,prop_id,iprop_val1,iprop_val2,iprop_val3,iprop_val4,iprop_is_petbonus,chanceof_id) VALUES"""
            for proprty in allProperties:
                insertPropQuery += """({},(SELECT prop_id FROM MAIN.PROPERTY WHERE prop_tag = '{}' AND prop_name_fr = '{}'),{},{},{},{},{},{})""".format(
                    iditem, # id
                    proprty[1], # property tag
                    proprty[2].replace("'","''"), # property name (fr)
                    proprty[0][0] if len(proprty[0]) > 0 else 0, # property value 1
                    proprty[0][1] if len(proprty[0]) > 1 else 0, # property value 2
                    proprty[0][2] if len(proprty[0]) > 2 else 0, # property value 3
                    proprty[0][3] if len(proprty[0]) > 3 else 0, # property value 4
                    proprty[3], # is property a petbonus
                    proprty[4] if proprty[4] != 0 else 'NULL' # chance
                )
                i+=1
                if i < len(allProperties):
                    insertPropQuery += """,\n"""
            insertPropQuery += """;\n"""
            if len(allProperties) > 0:
                cursor.execute(insertPropQuery)
    
    print("Insert successful")




############################################################################################################
#                                                     MAIN                                                 #
############################################################################################################
def insertIntoDB(co):
    data = loadDataFromJson()
    cursor = co.cursor()

    resetTables(cursor)

    insertClassification(data,cursor)
    insertItemType(data,cursor)
    insertProperties(data,cursor)
    insertItems(data,cursor)

    cursor.close()


timeElapsed = time.time()
try:
    co = connectDB()
    print("Successfuly connected to database")
    insertIntoDB(co)
    co.commit()

except (Exception, Error) as error:
    print(error)

finally:
    if(co):
        co.close()
    print("Execution time : %.2f seconds" % (time.time() - timeElapsed))
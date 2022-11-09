query = """DROP TABLE IF EXISTS main.ItemProperty;
DROP TABLE IF EXISTS main.Item;
DROP TABLE IF EXISTS main.Classification;
DROP TABLE IF EXISTS main.TypeItem;
DROP TABLE IF EXISTS Main.Property;

CREATE TABLE main.Property(
   idProperty SERIAL,
   propertyName VARCHAR(50) NOT NULL,
   propertyNbVariable INT NOT NULL,
   PRIMARY KEY(idProperty),
   UNIQUE(propertyName)
);

CREATE TABLE main.TypeItem(
   idTypeItem SERIAL,
   typeItemName VARCHAR(50),
   PRIMARY KEY(idTypeItem),
   UNIQUE(typeItemName)
);

CREATE TABLE main.Classification(
   idClassification SERIAL,
   classificationName VARCHAR(50),
   PRIMARY KEY(idClassification),
   UNIQUE(classificationName)
);

CREATE TABLE main.Item(
   idItem SERIAL,
   ItemTag VARCHAR(50),
   ItemLevelRequirement INT NOT NULL,
   ItemName VARCHAR(50),
   ItemDexterityRequirement INT,
   ItemIntelligenceRequirement INT,
   ItemStrenghRequirement INT,
   idClassification INT NOT NULL,
   idTypeItem INT NOT NULL,
   PRIMARY KEY(idItem),
   UNIQUE(ItemTag),
   FOREIGN KEY(idClassification) REFERENCES main.Classification(idClassification),
   FOREIGN KEY(idTypeItem) REFERENCES main.TypeItem(idTypeItem)
);

CREATE TABLE main.ItemProperty(
   idItem INT,
   idProperty INT,
   value1Min DECIMAL,
   value1Max DECIMAL,
   value2Min DECIMAL,
   value2Max DECIMAL,
   value3Min DECIMAL,
   value3Max DECIMAL,
   PRIMARY KEY(idItem, idProperty),
   FOREIGN KEY(idItem) REFERENCES main.Item(idItem),
   FOREIGN KEY(idProperty) REFERENCES main.Property(idProperty)
);"""

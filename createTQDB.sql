DROP TABLE IF EXISTS main.ItemProperty;
DROP TABLE IF EXISTS Main.ChanceOf;
DROP TABLE IF EXISTS main.Item;
DROP TABLE IF EXISTS main.Classification;
DROP TABLE IF EXISTS main.ITEM_TYPE;
DROP TABLE IF EXISTS Main.Property;

CREATE TABLE main.PROPERTY(
   prop_id SERIAL,
   prop_tag VARCHAR(100) NOT NULL,
   prop_name_fr VARCHAR(200),
   prop_name_en VARCHAR(200),
   prop_nb_variable INT NOT NULL,
   PRIMARY KEY(prop_id)
);

CREATE TABLE main.ITEM_TYPE(
   ityp_id SERIAL,
   ityp_name VARCHAR(100),
   PRIMARY KEY(ityp_id),
   UNIQUE(ityp_name)
);

CREATE TABLE main.CLASSIFICATION(
   class_id SERIAL,
   class_name VARCHAR(100),
   PRIMARY KEY(class_id),
   UNIQUE(class_name)
);

CREATE TABLE main.Item(
   item_id SERIAL,
   item_tag VARCHAR(100),
   item_req_lvl INT NOT NULL,
   item_name VARCHAR(100),
   item_req_dex INT,
   item_req_int INT,
   item_req_str INT,
   class_id INT NOT NULL,
   ityp_id INT NOT NULL,
   PRIMARY KEY(item_id),
   FOREIGN KEY(class_id) REFERENCES main.CLASSIFICATION(class_id),
   FOREIGN KEY(ityp_id) REFERENCES main.ITEM_TYPE(ityp_id)
);

CREATE TABLE main.ChanceOf(
   chanceof_id SERIAL,
   item_id INT NOT NULL,
   chanceof_perc DECIMAL,
   chanceof_desc VARCHAR(50),
   chanceof_is_bonus BOOLEAN NOT NULL,
   PRIMARY KEY(chanceof_id),
   FOREIGN KEY(item_id) REFERENCES main.Item(item_id)
);

CREATE TABLE main.ItemProperty(
   item_id INT,
   prop_id INT,
   chanceof_id INT,
   iprop_val1 DECIMAL,
   iprop_val2 DECIMAL,
   iprop_val3 DECIMAL,
   iprop_val4 DECIMAL,
   iprop_is_petbonus BOOLEAN NOT NULL,
   PRIMARY KEY(item_id,prop_id,iprop_is_petbonus),
   FOREIGN KEY(item_id) REFERENCES main.Item(item_id),
   FOREIGN KEY(chanceof_id) REFERENCES main.ChanceOf(chanceof_id),
   FOREIGN KEY(prop_id) REFERENCES main.Property(prop_id)
);

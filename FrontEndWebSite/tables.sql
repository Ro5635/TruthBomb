-- This is the database tables, initialy anyway...

CREATE TABLE ImageBank( ImageID int unsigned NOT NULL primary key , BankID int unsigned NOT NULL, Imagesrc varchar(300) NOT NULL , alt varchar(600));

-- Sites table

CREATE TABLE Sites(SiteID int unsigned NOT NULL primary key , SiteURL varchar(590) NOT NULL);


CREATE TABLE SiteRatings( ratingID int unsigned primary key auto_increment , SiteID int unsigned NOT NULL  , Rating int unsigned NOT NULL);

-- https://cdn.webaddressgoeshere.com/AstonUniHack/BBC_News_large_logo.png
-- cdn.webaddressgoeshere.com/AstonUniHack/Reuters_logo_emblem.png
-- cdn.webaddressgoeshere.com/AstonUniHack/The_Economist_logo.png


-- INSERT INTO ImageBank( ImageID , BankID  , Imagesrc , alt) VALUES( 244585433, 4727744 , "https://cdn.webaddressgoeshere.com/AstonUniHack/BBC_News_large_logo.png" , 'BBC News Logo');

-- INSERT INTO ImageBank( ImageID , BankID  , Imagesrc , alt) VALUES( 4725436, 4727744 , "https://cdn.webaddressgoeshere.com/AstonUniHack/Reuters_logo_emblem.png" , 'Reuters Logo');

-- INSERT INTO ImageBank( ImageID , BankID  , Imagesrc , alt) VALUES( 5746335, 4727744 , "https://cdn.webaddressgoeshere.com/AstonUniHack/The_Economist_logo.png" , 'The Economist Logo');

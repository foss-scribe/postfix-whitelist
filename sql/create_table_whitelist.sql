CREATE TABLE `whitelist` (
`sender` VARCHAR( 50 ) NOT NULL ,
`action` VARCHAR( 2 ) NOT NULL ,
UNIQUE ( `sender` )
);

CREATE TABLE `protected_users` (
`recipient` VARCHAR( 50 ) NOT NULL ,
`class` VARCHAR( 10 ) NOT NULL,
UNIQUE ( `recipient` )
);

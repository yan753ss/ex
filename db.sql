CREATE TABLE `msgs`(
    `id` INT AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL DEFAULT '',
    `msg` TEXT,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE PROCEDURE spCreateData(IN title VARCHAR(255), IN msg TEXT)
BEGIN
    INSERT INTO `msgs`(`title`, `msg`) VALUES(title, msg);
END

CALL spCreateData('First', 'Text for first...');
CALL spCreateData('Second', 'Text for second...');

CREATE PROCEDURE spReadData()
BEGIN
    SELECT `id`, `title`, `msg`, UNIX_TIMESTAMP(`created`) as `created` FROM msgs;
END

CALL spReadData();

CREATE PROCEDURE spReadDataById(IN idx INT)
BEGIN
    SELECT `id`, `title`, `msg` FROM msgs WHERE `id` = idx;
END

CALL spReadDataById(2);

CREATE PROCEDURE spUpdateData(IN idx INT, IN title VARCHAR(255), IN msg TEXT)
BEGIN
    UPDATE `msgs` SET
        `title` = title,
        `msg` = msg
    WHERE `id` = idx;
END

CALL spCreateData('Third', 'Text for third...');
CALL spUpdateData(2, 'Second!', 'Text for second!...');

CREATE PROCEDURE spDeleteData(IN idx INT)
BEGIN
    DELETE FROM msgs WHERE `id` = idx;
END

CALL spDeleteData(3);
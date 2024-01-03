SET SQL_MODE='ALLOW_INVALID_DATES';
ALTER TABLE `rii`
ADD `submitted_datetime` datetime NOT NULL AFTER `status_datetime`;
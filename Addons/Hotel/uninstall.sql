DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='hotel' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='hotel' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_hotel`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='hotel_order' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='hotel_order' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_hotel_order`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='hotel_room' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='hotel_room' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_hotel_room`;

DELETE FROM `wp_attribute` WHERE model_id = (SELECT id FROM wp_model WHERE `name`='hotel_room_type' ORDER BY id DESC LIMIT 1);
DELETE FROM `wp_model` WHERE `name`='hotel_room_type' ORDER BY id DESC LIMIT 1;
DROP TABLE IF EXISTS `wp_hotel_room_type`;
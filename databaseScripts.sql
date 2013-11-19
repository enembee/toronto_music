-- User credentials
-- username = music_admin
-- password = kXpH7Kyy

-- Create database
CREATE DATABASE toronto_music
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- Create SHOWS table
CREATE TABLE shows (
show_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
location_id INT UNSIGNED NOT NULL,
show_description VARCHAR(60) NOT NULL,
show_date DATETIME NOT NULL,
show_start TIME NOT NULL,
show_end TIME NOT NULL,
date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (show_id),
INDEX (location_id),
INDEX (show_date)
);

-- Create LOCATIONS table
CREATE TABLE locations (
location_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
location_name VARCHAR(40) NOT NULL,
address_1 VARCHAR(40) NOT NULL,
address_2 VARCHAR(40) NOT NULL,
city VARCHAR(20) NOT NULL,
postal_code VARCHAR(10),
PRIMARY KEY (location_id),
INDEX (location_name)
);

-- Create BANDS table
CREATE TABLE bands (
band_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
band_name VARCHAR(60) NOT NULL,
genre_id INT UNSIGNED NOT NULL,
PRIMARY KEY (band_id),
INDEX (band_name)
);

-- Create GENRES table
CREATE TABLE genres (
genre_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
genre_name VARCHAR(40) NOT NULL,
PRIMARY KEY (genre_id),
INDEX (genre_name)
);

-- Create SHOWS_BANDS link table
CREATE TABLE shows_bands (
show_id INT UNSIGNED NOT NULL,
band_id INT UNSIGNED NOT NULL,
PRIMARY KEY (show_id, band_id)
);

-- Add foreign keys
ALTER TABLE shows ADD FOREIGN KEY (location_id) REFERENCES locations (location_id);

ALTER TABLE bands ADD FOREIGN KEY (genre_id) REFERENCES genres (genre_id);

ALTER TABLE shows_bands ADD FOREIGN KEY (show_id) REFERENCES shows (show_id);

ALTER TABLE shows_bands ADD FOREIGN KEY (band_id) REFERENCES bands (band_id);
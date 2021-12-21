DROP DATABASE IF EXISTS main;

CREATE DATABASE main;
USE main;

CREATE TABLE users (
                       ID integer PRIMARY KEY AUTO_INCREMENT,
                       Name text NOT NULL,
                       Password text NOT NULL,
                       Type text NOT NULL
);

INSERT INTO users VALUES (1, 'admin', 'admin', 'ADMIN');
INSERT INTO users VALUES (2, 'Bier', 'user', 'USER');
INSERT INTO users VALUES (3, 'Cooler Typ', 'user', 'USER');
INSERT INTO users VALUES (4, 'Pfandsucher', 'user', 'USER');
INSERT INTO users VALUES (5, 'Kapitän zur See', 'user', 'USER');


CREATE TABLE mehms (
                       ID integer PRIMARY KEY AUTO_INCREMENT,
                       UserID integer NOT NULL REFERENCES Users(ID),
                       Path text NOT NULL UNIQUE,
                       Likes integer DEFAULT 0,
                       Type text,
                       Description text,
                       Visible boolean DEFAULT FALSE,
                       VisibleOn timestamp
);

-- Here we should insert some sample data
INSERT INTO mehms VALUES (1, 1, 'Algorithm_Parrot.jpg', 20, 'PROGRAMMING', NULL,true, now());
INSERT INTO mehms VALUES (2, 2, 'Binary_tree_pants.jpg', 5, 'PROGRAMMING', 'Lollllllllz',false, NULL);
INSERT INTO mehms VALUES (3, 3,  'C++_Python_Timmy.jpeg', 0, 'PROGRAMMING', 'Brüh',true, now());
INSERT INTO mehms VALUES (4, 5, 'Daniel_Baguecki_Baguette_Wierbicki.jpg', 99999, 'PEOPLE', 'DER BESTE!!!!!!!11!!', true, now());
INSERT INTO mehms VALUES (5, 5, 'Pizza_Pineapple.jpeg', 0, 'FOOD', NULL, true, now());

CREATE TABLE comments (
                          ID integer PRIMARY KEY AUTO_INCREMENT,
                          MehmID integer NOT NULL REFERENCES Mehms(ID),
                          UserID integer REFERENCES Users(ID),
                          Comment text
);

INSERT INTO comments VALUES (1, 4, 1, 'ECHT GEIL!!!!!!');
INSERT INTO comments VALUES (2, 4, 1, 'NOICE!!!');
INSERT INTO comments VALUES (3, 5, 2, 'Urgh.');


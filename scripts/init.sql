DROP DATABASE IF EXISTS main;

CREATE DATABASE main;
USE main;

CREATE TABLE users (
                       ID integer PRIMARY KEY AUTO_INCREMENT,
                       Name text UNIQUE NOT NULL,
                       Password text NOT NULL,
                       Type text NOT NULL
);

INSERT INTO users VALUES (1, 'admin', 'admin', 'ADMIN');
INSERT INTO users VALUES (2, 'Bier', 'user', 'USER');
INSERT INTO users VALUES (3, 'Cooler_Typ', 'user', 'USER');
INSERT INTO users VALUES (4, 'Pfandsucher', 'user', 'USER');
INSERT INTO users VALUES (5, 'Kapitän_zur_See', 'user', 'USER');


CREATE TABLE mehms (
                       ID integer PRIMARY KEY AUTO_INCREMENT,
                       UserID integer NOT NULL REFERENCES Users(ID),
                       Path text NOT NULL UNIQUE,
                       Type text,
                       Description text,
                       Visible boolean DEFAULT FALSE,
                       VisibleOn timestamp
);

-- Beispieldaten
INSERT INTO mehms VALUES (1, 1, 'Algorithm_Parrot.jpg',  'Programmieren', NULL,true, now());
INSERT INTO mehms VALUES (2, 2, 'Binary_tree_pants.jpg',  'Programmieren', 'Lollllllllz',false, NULL);
INSERT INTO mehms VALUES (3, 3,  'C++_Python_Timmy.jpeg', 'Programmieren', 'Brüh',true, now());
INSERT INTO mehms VALUES (4, 5, 'Daniel_Baguecki_Baguette_Wierbicki.jpg', 'DHBW', 'DER BESTE!!!!!!!11!!', true, now());
INSERT INTO mehms VALUES (5, 5, 'Pizza_Pineapple.jpeg', 'Andere', NULL, true, now());

CREATE TABLE comments (
                          ID integer PRIMARY KEY AUTO_INCREMENT,
                          MehmID integer NOT NULL REFERENCES Mehms(ID),
                          UserID integer REFERENCES Users(ID),
                          Comment text
);

INSERT INTO comments VALUES (1, 4, 1, 'ECHT GEIL!!!!!!');
INSERT INTO comments VALUES (2, 4, 1, 'NOICE!!!');
INSERT INTO comments VALUES (3, 5, 2, 'Urgh.');

CREATE TABLE likes (
                       MehmID integer REFERENCES mehms(ID),
                       UserID integer REFERENCES users(ID),
                       PRIMARY KEY (MehmID, UserID)
);

INSERT INTO likes VALUES (1, 1);
INSERT INTO likes VALUES (3, 1);
INSERT INTO likes VALUES (4, 1);
INSERT INTO likes VALUES (5, 1);
INSERT INTO likes VALUES (1, 2);
INSERT INTO likes VALUES (2, 2);
INSERT INTO likes VALUES (4, 2);
INSERT INTO likes VALUES (5, 3);
INSERT INTO likes VALUES (2, 3);
INSERT INTO likes VALUES (3, 5);
INSERT INTO likes VALUES (4, 5);
INSERT INTO likes VALUES (5, 5);

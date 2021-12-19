DROP DATABASE IF EXISTS main;

CREATE DATABASE main;
USE main;

CREATE TABLE Users (
    ID integer PRIMARY KEY AUTO_INCREMENT,
    Name text NOT NULL,
    Password text NOT NULL,
    Type text NOT NULL
);

INSERT INTO Users VALUES (1, 'admin', 'admin', 'ADMIN');
INSERT INTO Users VALUES (2, 'user', 'user', 'USER');

CREATE TABLE Mehms (
    ID integer PRIMARY KEY AUTO_INCREMENT,
    Path text NOT NULL UNIQUE,
    Likes integer,
    Type text,
    Description text,
    Visible boolean,
    VisibleOn timestamp
);

-- Here we should insert some sample data
INSERT INTO Mehms VALUES (1, 'Algorithm_Parrot.jpg', 20, 'PROGRAMMING', NULL,true, now());
INSERT INTO Mehms VALUES (2, 'Binary_tree_pants.jpg', 5, 'PROGRAMMING', 'Lollllllllz',false, NULL);
INSERT INTO Mehms VALUES (3, 'C++_Python_Timmy.jpeg', 0, 'PROGRAMMING', 'Brüh',true, now());
INSERT INTO Mehms VALUES (4, 'Daniel_Baguecki_Baguette_Wierbicki.jpg', 99999, 'DER BESTE!!!!!!!11!!', 'PEOPLE', true, now());
INSERT INTO Mehms VALUES (5, 'Pizza_Pineapple.jpeg', 0, 'FOOD', NULL, true, now());

CREATE TABLE Comments (
    ID integer PRIMARY KEY AUTO_INCREMENT,
    MehmID integer NOT NULL REFERENCES Mehms(ID),
    UserID integer REFERENCES Users(ID),
    EMail text,
    Comment text
);

INSERT INTO Comments VALUES (1, 4, 1, NULL, 'ECHT GEIL!!!!!!');
INSERT INTO Comments VALUES (2, 4, 1, NULL, 'NOICE!!!');
INSERT INTO Comments VALUES (3, 5, NULL, 'hans@wurst.de', 'Urgh.');


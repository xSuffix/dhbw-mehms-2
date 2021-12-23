DROP DATABASE IF EXISTS main;

CREATE DATABASE main;
USE main;

CREATE TABLE users
(
    ID       integer PRIMARY KEY AUTO_INCREMENT,
    Name     text UNIQUE NOT NULL,
    Password text        NOT NULL,
    Type     text        NOT NULL
);

INSERT INTO users
VALUES (1, 'admin', 'admin', 'ADMIN');
INSERT INTO users
VALUES (2, 'Bier', 'user', 'USER');
INSERT INTO users
VALUES (3, 'Cooler_Typ', 'user', 'USER');
INSERT INTO users
VALUES (4, 'Pfandsucher', 'user', 'USER');
INSERT INTO users
VALUES (5, 'Kapitän_zur_See', 'user', 'USER');


CREATE TABLE mehms
(
    ID          integer PRIMARY KEY AUTO_INCREMENT,
    UserID      integer NOT NULL,
    Path        text    NOT NULL UNIQUE,
    Title       text    NOT NULL,
    Type        text,
    Description text,
    Visible     boolean DEFAULT FALSE,
    VisibleOn   timestamp,
    FOREIGN KEY (UserID) REFERENCES Users (ID) ON DELETE CASCADE
);

-- Beispieldaten
INSERT INTO mehms
VALUES (1, 1, 'Algorithm_Parrot.jpg', 'Birb', 'Programmieren', NULL, true, now());
INSERT INTO mehms
VALUES (2, 2, 'Binary_tree_pants.jpg', 'Binary Tree has pants', 'Programmieren', 'Lollllllllz', false, NULL);
INSERT INTO mehms
VALUES (3, 3, 'C++_Python_Timmy.jpeg', 'Timmy lernt C++', 'Programmieren', 'PROGRAMMING', true, now());
INSERT INTO mehms
VALUES (4, 5, 'Daniel_Baguecki_Baguette_Wierbicki.jpg', 'Daniel der Baguette-Meister', 'DHBW', 'DER BESTE!!!!!!!11!!',
        true, now());
INSERT INTO mehms
VALUES (5, 5, 'Pizza_Pineapple.jpeg', 'Pizza Pineapple', 'Andere', NULL, true, now());

CREATE TABLE comments
(
    ID        integer PRIMARY KEY AUTO_INCREMENT,
    MehmID    integer NOT NULL,
    UserID    integer,
    Comment   text,
    Timestamp timestamp DEFAULT now(),
    FOREIGN KEY (MehmID) REFERENCES mehms (ID) ON DELETE CASCADE,
    FOREIGN KEY (UserID) REFERENCES users (ID) ON DELETE CASCADE
);

INSERT INTO comments
VALUES (1, 4, 1, 'ECHT GEIL!!!!!!', now());
INSERT INTO comments
VALUES (2, 4, 1, 'NOICE!!!', now());
INSERT INTO comments
VALUES (3, 5, 2, 'Urgh.', now());

CREATE TABLE likes
(
    MehmID integer,
    UserID integer,
    PRIMARY KEY (MehmID, UserID),
    FOREIGN KEY (MehmID) REFERENCES mehms (ID) ON DELETE CASCADE,
    FOREIGN KEY (UserID) REFERENCES users (ID) ON DELETE CASCADE
);

INSERT INTO likes
VALUES (1, 1);
INSERT INTO likes
VALUES (3, 1);
INSERT INTO likes
VALUES (4, 1);
INSERT INTO likes
VALUES (5, 1);
INSERT INTO likes
VALUES (1, 2);
INSERT INTO likes
VALUES (2, 2);
INSERT INTO likes
VALUES (4, 2);
INSERT INTO likes
VALUES (5, 3);
INSERT INTO likes
VALUES (2, 3);
INSERT INTO likes
VALUES (3, 5);
INSERT INTO likes
VALUES (4, 5);
INSERT INTO likes
VALUES (5, 5);

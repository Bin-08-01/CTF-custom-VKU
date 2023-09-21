PRAGMA foreign_keys = ON;

CREATE TABLE users(
    userid INTEGER PRIMARY KEY,
    password TEXT NOT NULL
);

CREATE TABLE gemdata(
    gems INTEGER NOT NULL DEFAULT 0 CHECK(gems >= 0),
    userid TEXT NOT NULL UNIQUE,
    FOREIGN KEY (userid) REFERENCES users (userid)
);

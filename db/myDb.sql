/*Create author table*/
CREATE TABLE author
(
	id SERIAL,
	first_name VARCHAR(100) NOT NULL,
	middle_name VARCHAR(100),
	last_name VARCHAR(100) NOT NULL,
	is_blacklist BOOLEAN,
	is_favorite BOOLEAN,
	PRIMARY KEY (id)
);
/* author inserts */
INSERT INTO author (first_name, last_name) VALUES ('Jane', 'Austen');
INSERT INTO author (first_name, last_name, is_favorite) VALUES ('Tracie', 'Peterson', TRUE);
INSERT INTO author (first_name, last_name, is_favorite) VALUES ('Dee', 'Henderson', TRUE);
INSERT INTO author (first_name, middle_name, last_name, is_favorite) VALUES ('Kristi', 'Ann', 'Hunter', TRUE);
INSERT INTO author (first_name, last_name, is_favorite) VALUES ('John', 'Flanagan', TRUE);
INSERT INTO author (first_name, last_name, is_blacklist) VALUES ('J.K.', 'Rowling', TRUE);
/* search for favorites */
SELECT first_name, last_name FROM author WHERE is_favorite = TRUE;
/* create book title table */
CREATE TABLE book_title
(
	id SERIAL,
	author_id INT NOT NULL,
	title_of_book VARCHAR(100) NOT NULL,
	is_owned BOOLEAN NOT NULL,
	own_wish_list BOOLEAN,
	read_wish_list BOOLEAN,
	PRIMARY KEY (id),
	FOREIGN KEY (author_id) REFERENCES author(id)
);
/* book title inserts */
INSERT INTO book_title (author_id, title_of_book, is_owned, own_wish_list, read_wish_list) VALUES (4, 'A Noble Masquerade',FALSE, TRUE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, own_wish_list, read_wish_list) VALUES (4, 'An Elegant Facade',FALSE, TRUE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, own_wish_list, read_wish_list) VALUES (4, 'A Lady of Esteem',FALSE, TRUE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned) VALUES (5, 'Ranger''s Apprentice: The Battle of Hackham Heath', TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned) VALUES (1, 'Pride and Prejudice', TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned) VALUES (1, 'Sense and Sensibility', TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (2, 'Treasured Grace', FALSE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (2, 'In The Shadow of Denali', FALSE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (2, 'When You are Near', FALSE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (2, 'Treasured Grace', FALSE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (3, 'Unspoken', FALSE, TRUE);
INSERT INTO book_title (author_id, title_of_book, is_owned, read_wish_list) VALUES (3, 'Undetected', FALSE, TRUE);
/* select author names by author by id */
SELECT author.first_name, author.middle_name, author.last_name, book_title.title_of_book FROM author INNER JOIN book_title ON author.id = book_title.author_id;
/* select books by owned wish list */
SELECT * FROM book_title WHERE own_wish_list = TRUE;
/* select books by read wish list */
SELECT * FROM book_title WHERE read_wish_list = TRUE;
/* create reviews table */
CREATE TABLE reviews
(
	id SERIAL,
	book_title_id INT NOT NULL,
	review TEXT NOT NULL,
	rating INT,
	PRIMARY KEY (id),
	FOREIGN KEY (book_title_id) REFERENCES book_title(id)
);
/* insert reviews */
INSERT INTO reviews (book_title_id, review, rating) VALUES (1, 'Loved the mystery and humor involved in the historical romance', 5);
/* create borrowers */
CREATE TABLE borrower
(
	id SERIAL,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	phone_number VARCHAR(12) NOT NULL,
	PRIMARY KEY (id)
);
/* insert borrowers */
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Karina', 'Hansen', '208-206-1488');
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Kayli', 'Hansen', '208-206-1488');
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Breanna', 'Hansen', '208-206-1488');
/* create loan table */
CREATE TABLE loan
(
	id SERIAL,
	book_title_id INT NOT NULL,
	borrower_id INT NOT NULL, 
	date_borrowed DATE NOT NULL,
	return_date DATE,
	is_returned BOOLEAN NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (book_title_id) REFERENCES book_title(id),
	FOREIGN KEY (borrower_id) REFERENCES borrower(id)
);
/* insert loans */
INSERT INTO loan (book_title_id, borrower_id, date_borrowed, is_returned) VALUES (4, 2, DATE '01-23-2021', FALSE);
INSERT INTO loan (book_title_id, borrower_id, date_borrowed, is_returned) VALUES (3, 1, DATE '01-22-2021', FALSE);

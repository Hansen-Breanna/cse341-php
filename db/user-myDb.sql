/*Create author table*/
CREATE TABLE author
(
	id SERIAL,
	first_name VARCHAR(100) NOT NULL,
	middle_name VARCHAR(100),
	last_name VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
);
/* author inserts */
INSERT INTO author (first_name, last_name) VALUES ('Jane', 'Austen');
INSERT INTO author (first_name, last_name) VALUES ('Tracie', 'Peterson');
INSERT INTO author (first_name, last_name) VALUES ('Dee', 'Henderson');
INSERT INTO author (first_name, middle_name, last_name) VALUES ('Kristi', 'Ann', 'Hunter');
INSERT INTO author (first_name, last_name) VALUES ('John', 'Flanagan');
INSERT INTO author (first_name, last_name) VALUES ('J.K.', 'Rowling');
/* search for favorites */
SELECT first_name, last_name FROM author WHERE is_favorite = TRUE;
/* create user */
CREATE TABLE library_user
(
	id serial,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	username VARCHAR(40) NOT NULL,
	user_password VARCHAR(40) NOT NULL,
	user_email VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
);
INSERT INTO library_user (first_name, last_name, username, user_password, user_email) VALUES ('Breanna', 'Hansen', 'hansen', 'test', 'test@email.com'); 
INSERT INTO library_user (first_name, last_name, username, user_password, user_email) VALUES ('Chase', 'Wilcox', 'wilcox', 'test', 'test@email.com');
INSERT INTO library_user (first_name, last_name, username, user_password, user_email) VALUES ('Brother', 'Lyon', 'lyon', 'test', 'test@email.com');
/* create user/author bridge table */
CREATE TABLE user_author
(
	id serial,
	library_user_id INT NOT NULL,
	author_id INT NOT NULL,
	is_blacklist BOOLEAN,
	is_favorite BOOLEAN,
	PRIMARY KEY (id),
	FOREIGN KEY (library_user_id) REFERENCES library_user(id),
	FOREIGN KEY (author_id) REFERENCES author(id)
);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (1, 1, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (1, 2, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (1, 3, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (1, 6, TRUE, FALSE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (2, 3, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (2, 4, TRUE, FALSE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (3, 5, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (3, 6, TRUE, FALSE);
/* create book title table */
CREATE TABLE book_title
(
	id SERIAL,
	author_id INT NOT NULL,
	title_of_book VARCHAR(100) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (author_id) REFERENCES author(id)
);
/* book title inserts */
INSERT INTO book_title (author_id, title_of_book) VALUES (4, 'A Noble Masquerade');
INSERT INTO book_title (author_id, title_of_book) VALUES (4, 'An Elegant Facade');
INSERT INTO book_title (author_id, title_of_book) VALUES (4, 'A Lady of Esteem');
INSERT INTO book_title (author_id, title_of_book) VALUES (5, 'Ranger''s Apprentice: The Battle of Hackham Heath');
INSERT INTO book_title (author_id, title_of_book) VALUES (1, 'Pride and Prejudice');
INSERT INTO book_title (author_id, title_of_book) VALUES (1, 'Sense and Sensibility');
INSERT INTO book_title (author_id, title_of_book) VALUES (2, 'Treasured Grace');
INSERT INTO book_title (author_id, title_of_book) VALUES (2, 'In The Shadow of Denali');
INSERT INTO book_title (author_id, title_of_book) VALUES (2, 'When You are Near');
INSERT INTO book_title (author_id, title_of_book) VALUES (2, 'Treasured Grace');
INSERT INTO book_title (author_id, title_of_book) VALUES (3, 'Unspoken');
INSERT INTO book_title (author_id, title_of_book) VALUES (3, 'Undetected');
/* select author names by author by id */
SELECT author.first_name, author.middle_name, author.last_name, book_title.title_of_book FROM author INNER JOIN book_title ON author.id = book_title.author_id;
/* create book owned table */
CREATE TABLE user_book
(
	id serial,
	library_user_id INT NOT NULL,
	book_title_id INT NOT NULL,
	is_owned BOOLEAN NOT NULL,
	own_wish_list BOOLEAN,
	read_wish_list BOOLEAN,
	PRIMARY KEY (id),
	FOREIGN KEY (library_user_id) REFERENCES library_user(id),
	FOREIGN KEY (book_title_id) REFERENCES book_title(id)	
);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (1, 1, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (1, 2, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (1, 3, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned) VALUES (1, 4, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned) VALUES (1, 5, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned) VALUES (1, 6, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (2, 7, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (2, 8, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (2, 9, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (2, 10, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (3, 11, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (3, 12, FALSE, TRUE);
/* create reviews table */
CREATE TABLE reviews
(
	id SERIAL,
	library_user_id INT NOT NULL,
	book_title_id INT NOT NULL,
	review TEXT NOT NULL,
	rating INT,
	PRIMARY KEY (id),
    FOREIGN KEY (library_user_id) REFERENCES library_user(id),
	FOREIGN KEY (book_title_id) REFERENCES book_title(id)
);
/* insert reviews */
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (1, 1, 'Loved the mystery and humor involved in the historical romance', 5);
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (2, 1, 'Deathly boring.', 5);
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (3, 2, 'Great read for my wife. Not so much for me.', 5);
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
	library_user_id INT NOT NULL,
	book_title_id INT NOT NULL,
	borrower_id INT NOT NULL, 
	date_borrowed DATE NOT NULL,
	return_date DATE,
	is_returned BOOLEAN NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (library_user_id) REFERENCES library_user(id),
	FOREIGN KEY (book_title_id) REFERENCES book_title(id),
	FOREIGN KEY (borrower_id) REFERENCES borrower(id)
);
/* insert loans */
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (1, 4, 2, DATE '01-23-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (1, 3, 1, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, return_date, is_returned) VALUES (1, 2, 1, DATE '01-02-2021', DATE '01-20-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (2, 3, 2, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (2, 5, 3, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (3, 6, 1, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (3, 3, 2, DATE '01-22-2021', FALSE);


SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = 1 ORDER BY b.title_of_book; 

SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = 1 AND own_wish_list = TRUE ORDER BY b.title_of_book; 

SELECT b.title_of_book, bo.first_name, bo.last_name, bo.phone_number, l.date_borrowed, l.return_date, l.is_returned, lu.user_phone FROM loan l INNER JOIN book_title b ON l.book_title_id = b.id INNER JOIN library_user lu ON lu.id = l.library_user_id INNER JOIN borrower bo ON l.borrower_id = bo.id WHERE l.library_user_id = 1 ORDER BY date_borrowed DESC;




SELECT r.book_title_id, r.review, r.rating, lu.username FROM reviews r INNER JOIN library_user lu;

SELECT a.first_name, a.middle_name, a.last_name, u.is_blacklist, u.is_favorite FROM author a INNER JOIN user_author u ON a.id = u.author_id WHERE u.library_user_id = 3;

	library_user_id INT NOT NULL,
	author_id INT NOT NULL,
	is_blacklist BOOLEAN,
	is_favorite BOOLEAN,
    
SELECT b.title_of_book, a.first_name, a.middle_name, a.last_name FROM user_book u INNER JOIN book_title b ON u.book_title_id = b.id INNER JOIN author a ON a.id = b.author_id WHERE u.library_user_id = :id AND b.book_title = "An Elegant Facade" ORDER BY b.title_of_book
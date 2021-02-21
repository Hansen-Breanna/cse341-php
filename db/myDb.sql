/*Create author table*/
CREATE TABLE author
(
	id SERIAL,
	first_name VARCHAR(100) NOT NULL,
	middle_name VARCHAR(100),
	last_name VARCHAR(100) NOT NULL,
	PRIMARY KEY (id),
    ADD CONSTRAINT UC_full_author UNIQUE (first_name, middle_name, last_name),
    ADD CONSTRAINT UC_partial_author UNIQUE (first_name, last_name)
);
/* author inserts */
INSERT INTO author (first_name, middle_name, last_name) VALUES ('F.', 'Scott', 'Fitzgerald');
INSERT INTO author (first_name, last_name) VALUES ('Marcel', 'Proust');
INSERT INTO author (first_name, last_name) VALUES ('William', 'Faulkner');
INSERT INTO author (first_name, last_name) VALUES ('James', 'Joyce');

/* create user */
CREATE TABLE library_user
(
	id serial,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	username VARCHAR(100) NOT NULL,
	user_password VARCHAR(255) NOT NULL,
	user_email VARCHAR(50) NOT NULL,
    user_phone VARCHAR(12),
	PRIMARY KEY (id)
);
/* non-hashed password for all is 'testing2021' */
INSERT INTO library_user (first_name, last_name, username, user_password, user_email, user_phone) VALUES ('Breanna', 'Hansen', 'Breanna', '$2y$10$JM.xjaOGq.AlTb7OXWE5Ie6JSlbEeqe85KdW5v4fi/jPu7ZqqUA/G', 'test@email.com', '2082061488'); 
INSERT INTO library_user (first_name, last_name, username, user_password, user_email, user_phone) VALUES ('Chase', 'Wilcox', 'wilcox', '$2y$10$JM.xjaOGq.AlTb7OXWE5Ie6JSlbEeqe85KdW5v4fi/jPu7ZqqUA/G', 'test@email.com', '2082061488');
INSERT INTO library_user (first_name, last_name, username, user_password, user_email, user_phone) VALUES ('Brother', 'Lyon', 'lyon', '$2y$10$JM.xjaOGq.AlTb7OXWE5Ie6JSlbEeqe85KdW5v4fi/jPu7ZqqUA/G', 'test@email.com', '2082061488');

/* create user/author bridge table */
CREATE TABLE user_author
(
	id serial,
	library_user_id INT NOT NULL,
	author_id INT NOT NULL,
	is_blacklist BOOLEAN,
	is_favorite BOOLEAN,
	PRIMARY KEY (id),
	ADD CONSTRAINT FK_UserAuthor_User FOREIGN KEY (library_user_id) REFERENCES library_user(id) ON DELETE CASCADE,
	ADD CONSTRAINT FK_UserAuthor_Author FOREIGN KEY (author_id) REFERENCES author(id) ON DELETE CASCADE,
    ADD CONSTRAINT UC_user_author UNIQUE (library_user_id, author_id)
);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (11, 173, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (11, 174, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (11, 175, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (11, 176, TRUE, FALSE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (15, 175, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (15, 176, TRUE, FALSE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (16, 173, FALSE, TRUE);
INSERT INTO user_author (library_user_id, author_id, is_blacklist, is_favorite) VALUES (16, 174, TRUE, FALSE);
/* create book title table */
CREATE TABLE book_title
(
	id SERIAL,
	author_id INT NOT NULL,
	title_of_book VARCHAR(100) NOT NULL,
	PRIMARY KEY (id),
	ADD CONSTRAINT FK_BookTitle_Author FOREIGN KEY (author_id) REFERENCES author(id) ON DELETE CASCADE
);
/* book title inserts */
INSERT INTO book_title (author_id, title_of_book) VALUES (173, 'The Great Gatsby');
INSERT INTO book_title (author_id, title_of_book) VALUES (174, 'In Search of Lost Time');
INSERT INTO book_title (author_id, title_of_book) VALUES (175, 'The Sounds and the Fury');
INSERT INTO book_title (author_id, title_of_book) VALUES (176, 'Ulysses');
INSERT INTO book_title (author_id, title_of_book) VALUES (176, 'Dubliners');

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
	ADD CONSTRAINT FK_UserBook_User FOREIGN KEY (library_user_id) REFERENCES library_user(id) ON DELETE CASCADE,
	ADD CONSTRAINT FK_UserBook_BookTitle FOREIGN KEY (book_title_id) REFERENCES book_title(id) ON DELETE CASCADE	
);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (11, 98, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (11, 99, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, own_wish_list, read_wish_list) VALUES (11, 100, FALSE, TRUE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned) VALUES (11, 101, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (15, 98, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (15, 99, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (16, 100, FALSE, TRUE);
INSERT INTO user_book (library_user_id, book_title_id, is_owned, read_wish_list) VALUES (16, 102, FALSE, TRUE);

/* create reviews table */
CREATE TABLE reviews
(
	id SERIAL,
	library_user_id INT NOT NULL,
	book_title_id INT NOT NULL,
	review TEXT NOT NULL,
	rating INT,
	PRIMARY KEY (id),
    ADD CONSTRAINT FK_Reviews_User FOREIGN KEY (library_user_id) REFERENCES library_user(id) ON DELETE CASCADE,
	ADD CONSTRAINT FK_Reviews_BookTitle FOREIGN KEY (book_title_id) REFERENCES book_title(id) ON DELETE CASCADE
);
/* insert reviews */
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (11, 98, 'A true classic of twentieth-century literature', 5);
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (15, 99, 'Worth reading time and time again.', 5);
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (15, 100, 'No doubt this is a difficult book but it has a great payoff.', 5);
INSERT INTO reviews (library_user_id, book_title_id, review, rating) VALUES (16, 102, 'Collection of 15 short stories.', 4);

/* create borrowers */
CREATE TABLE borrower
(
	id SERIAL,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	phone_number VARCHAR(12) NOT NULL,
    middle_name VARCHAR(100),
	PRIMARY KEY (id),
    ADD CONSTRAINT UC_Borrower_Name UNIQUE (first_name, last_name)
);
/* insert borrowers */
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Todd', 'Scott', '208-206-1488');
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Maple', 'Wilson', '208-206-1488');
INSERT INTO borrower (first_name, last_name, phone_number) VALUES ('Avery', 'Johnson', '208-206-1488');

/* create user_borrower */
CREATE TABLE user_borrower
(
    id SERIAL,
    library_user_id INT NOT NULL,
    borrower_id INT NOT NULL,
    PRIMARY KEY (id),
    ADD CONSTRAINT FK_User_Borrower_User_ID FOREIGN KEY (library_user_id) REFERENCES library_user(id) ON DELETE CASCADE,
    ADD CONSTRAINT FK_User_Borrower_Borrower_ID FOREIGN KEY (borrower_id) REFERENCES borrower(id) ON DELETE CASCADE
);
/* insert borrowers for a user */
INSERT INTO user_borrower (library_user_id, borrower_id) VALUES (11, 30);
INSERT INTO user_borrower (library_user_id, borrower_id) VALUES (15, 31);
INSERT INTO user_borrower (library_user_id, borrower_id) VALUES (16, 32);

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
	ADD CONSTRAINT FK_Loan_User FOREIGN KEY (library_user_id) REFERENCES library_user(id) ON DELETE CASCADE,
	ADD CONSTRAINT FK_Loan_BookTitle FOREIGN KEY (book_title_id) REFERENCES book_title(id) ON DELETE CASCADE,
	ADD CONSTRAINT FK_Loan_Borrower FOREIGN KEY (borrower_id) REFERENCES borrower(id) ON DELETE CASCADE
);
/* insert loans */
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (11, 98, 30, DATE '01-23-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (11, 99, 31, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (15, 100, 32, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (15, 101, 31, DATE '01-22-2021', FALSE);
INSERT INTO loan (library_user_id, book_title_id, borrower_id, date_borrowed, is_returned) VALUES (16, 102, 30, DATE '01-22-2021', FALSE);

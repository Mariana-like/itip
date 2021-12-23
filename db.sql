-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE users (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	admin_level int NOT NULL DEFAULT 0,
	register_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `users`
--

INSERT INTO users (id, username, email, password, admin_level) VALUES
(1, 'administrator', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1);


-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE items (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	user_id int NOT NULL,
	title varchar(255) NOT NULL DEFAULT '',
	item_image varchar(255) NOT NULL,
	sort_order int NOT NULL
);

--
-- Dumping data for table `items`
--

INSERT INTO items (user_id, title, item_image, sort_order) VALUES
(1, 'Lorem ipsum', 'test1.jpg', 1),
(1, 'Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet', 'test2.jpg', 2),
(1, '', 'test3.jpg', 3),
(1, '', 'test4.jpg', 4);


-- --------------------------------------------------------



CREATE TABLE `user_details` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user_details VALUES("ABC", "123");
INSERT INTO user_details VALUES("Sayanb", "1234");
INSERT INTO user_details VALUES("amit", "amit123");
INSERT INTO user_details VALUES("caldwell", "caldwell12");
INSERT INTO user_details VALUES("caldwell2", "caldwell3");
INSERT INTO user_details VALUES("sumit", "sumit123");

DROP DATABASE IF EXISTS learning;
CREATE DATABASE learning;

DROP USER IF EXISTS 'abc'@'localhost';
DROP USER IF EXISTS 'abc'@'127.0.0.1';

CREATE USER 'abc'@'localhost' IDENTIFIED BY 'abc123';
CREATE USER 'abc'@'127.0.0.1' IDENTIFIED BY 'abc123';

GRANT ALL PRIVILEGES ON learning.* TO 'abc'@'localhost';
GRANT ALL PRIVILEGES ON learning.* TO 'abc'@'127.0.0.1';

USE learning;

DROP TABLE IF EXISTS STUDTBL;
CREATE TABLE IF NOT EXISTS STUDTBL
(studid INT(5) AUTO_INCREMENT,
fname VARCHAR(150) NOT NULL,
email VARCHAR(50) UNIQUE,
pass VARCHAR(100),
PRIMARY KEY (studid)
);

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `courses_id` int(10) NOT NULL AUTO_INCREMENT,
  `courses_name` varchar(50) NOT NULL,
  `courses_level` varchar(20) NOT NULL,
  `planguage` varchar(35) NOT NULL,
  `image` text NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 NOT NULL,
  `explanation` text NOT NULL,
  `prerequisites` text NOT NULL,
  `Test_question` text NOT NULL,
  `choise_one` varchar(25) NOT NULL,
  `choise_tow` varchar(25) NOT NULL,
  `choise_three` varchar(25) NOT NULL,
  `correct_answer` varchar(25) NOT NULL,
  PRIMARY KEY (`courses_id`)
);

DROP TABLE IF EXISTS feedback;
CREATE TABLE IF NOT EXISTS feedback
(feedid INT(5) AUTO_INCREMENT,
studid int NOT NULL,
courses_id int NOT NULL,
msg VARCHAR(200)NOT NULL,
PRIMARY KEY (feedid)
);


DROP TABLE IF EXISTS ADMINs;
CREATE TABLE IF NOT EXISTS ADMINs (
adminid INT(5) AUTO_INCREMENT,
pass VARCHAR(100) NOT NULL,
email VARCHAR(50) UNIQUE,
phone_number VARCHAR(10) NOT NULL,
PRIMARY KEY (adminid)
);


INSERT INTO `STUDTBL` ( `fname`, `email`, `pass`) 
VALUES( 'Mujahid', 'mm@gmail.com', '32109876');

INSERT INTO `courses` (`courses_id`, `courses_name`, `courses_level`, `planguage`, `image`, `video`, `explanation`, `prerequisites`, `Test_question`, `choise_one`, `choise_tow`, `choise_three`, `correct_answer`) VALUES
(3, 'Java 101', 'Beginner', 'Java', 'IMG-646cff7c909619.38993115.png', 'https://www.youtube.com/watch?v=xk4_1vDrzzo', 'A Beginner\'s Guide to Java Programming\" is a comprehensive introductory course that equips beginners with the fundamental knowledge and skills needed to start their journey in Java programming. Led by experienced instructors, this course covers core concepts such as variables, data types, control structures, and object-oriented programming. Through hands-on exercises and real-world examples, students gain practical experience and develop a solid foundation in Java. By the end of the course, learners will be equipped to write clean code, understand OOP principles, and explore advanced topics like exception handling and file I/O. Join Java 101 to unlock the power of Java programming and confidently embark on building web applications, mobile apps, or desktop software.', 'Understanding of programming concepts: While Java 101 is designed for beginners, having a basic understanding of programming concepts can be beneficial. Familiarity with concepts like variables, control structures (such as loops and conditionals), and functions will help you grasp the material more quickly.', 'What is the correct syntax for declaring a variable in Java?\r\n', 'var = 5;', 'int x = 5;', 'x = 5;', 'int x = 5;'),
(8, 'Flutter 101', 'Beginner', 'Flutter', 'IMG-646cff30e09d79.24761819.png', 'https://www.youtube.com/watch?v=VPvVD8t02U8&pp=ygULRmx1dHRlciAxMDE%3D', 'Building Cross-Platform Apps with Flutter\" is a comprehensive introductory course that equips beginners and experienced developers alike with the essential skills to create stunning and performant mobile applications. Guided by industry experts, you\'ll dive into Flutter\'s powerful UI toolkit, learning widget-based UI development, state management, navigation, and working with external APIs. With Flutter\'s ability to create apps that run natively on both iOS and Android platforms, combined with its hot reload feature for rapid iteration, you\'ll gain the knowledge and practical experience to build responsive, beautiful, and high-performance mobile apps. Join Flutter 101 to unlock the potential of Flutter app development and start creating cross-platform mobile experiences that bring your ideas to life.', 'Basic programming knowledge: Familiarity with programming concepts and fundamentals is beneficial before diving into Flutter. Understanding concepts like variables, loops, conditionals, and functions will help you grasp Flutter\'s concepts more easily.', 'What programming language is used in Flutter development?', 'Java', 'Swift', 'Dart', 'Dart'),
(5, 'Python 101', 'Beginner', 'Python', 'IMG-646b0d62bdccc7.31015346.jpg', 'https://www.youtube.com/watch?v=rfscVS0vtbw&pp=ygUJcHl0aG9uMTAx', 'An Introduction to Python Programming\" is a comprehensive course designed to provide beginners with a solid foundation in Python programming. Whether you\'re new to coding or have experience in other languages, Python 101 will equip you with the essential knowledge and skills to write clean, efficient, and functional Python code. Guided by experienced instructors, you\'ll explore the core concepts of Python, including variables, data types, control structures, functions, and object-oriented programming. Through hands-on exercises, practical examples, and real-world projects, you\'ll gain confidence in solving problems, manipulating data, and building simple applications. Join Python 101 to unlock the power of Python and embark on your journey as a proficient Python programmer, ready to tackle diverse projects and contribute to the world of software development.', 'Fundamental programming concepts: Having a basic understanding of programming concepts such as variables, data types, control structures (if statements, loops), and functions will provide a solid foundation for learning Python. This knowledge can be gained from introductory programming courses or self-study resources.', 'Which of the following is a valid variable name in Python?\r\n', 'myVariable', '_my_variable', '123variable', '_my_variable'),
(6, 'Python 102', 'Intermediate', 'Python', 'IMG-646b0d62bdccc7.31015346.jpg', 'https://www.youtube.com/watch?v=8hH0X1haJTU&pp=ygUKcHl0aG9uIDEwMg%3D%3D', 'Advanced Python Programming\" is an immersive course that builds upon the foundational knowledge gained in Python 101. Designed for learners with some experience in Python, this course delves deeper into advanced programming concepts and techniques, empowering you to write more sophisticated and efficient Python code. Through comprehensive lessons and hands-on exercises, you\'ll explore topics such as object-oriented programming, data structures, file handling, error handling, regular expressions, and working with external libraries. Python 102 equips you with the skills to tackle complex programming challenges and develop robust Python applications. Whether you aspire to become a professional Python developer or enhance your existing Python skills, Python 102 is your gateway to mastering the intricacies of Python and taking your programming abilities to the next level.', 'Object-oriented programming (OOP) knowledge: Python is an object-oriented programming language, and understanding the principles of OOP, such as classes, objects, inheritance, and encapsulation, is crucial for advanced Python programming. Familiarize yourself with OOP concepts and their implementation in Python.', 'Which of the following is an example of an immutable data type in Python?', 'Tuple', 'List', 'Dictionary', 'Tuple'),
(7, 'Python 103', 'Advanced', 'Python', 'IMG-646b0d62bdccc7.31015346.jpg', 'https://www.youtube.com/watch?v=UJYzBBFlBz4&pp=ygUKcHl0aG9uIDEwMw%3D%3D', 'Advanced Topics in Python\" is an intensive course designed for experienced Python developers seeking to enhance their skills and tackle complex programming challenges. Building upon the knowledge gained in Python 101 and Python 102, Python 103 delves into advanced topics and techniques that push the boundaries of Python programming. Topics covered include multithreading, multiprocessing, networking, database integration, web scraping, data analysis, and more. Through hands-on projects and practical exercises, you\'ll gain practical experience in applying these advanced concepts to real-world scenarios. Python 103 equips you with the tools and knowledge needed to build robust and scalable applications, leverage external APIs and libraries, and optimize code for performance. Join Python 103 to take your Python expertise to new heights and become a proficient Python developer capable of tackling diverse and challenging projects.', 'Proficiency in Python programming: A strong understanding of Python fundamentals, including variables, data types, control structures, functions, object-oriented programming (OOP), file handling, and error handling, is essential. You should be comfortable writing Python code, understanding its syntax, and implementing basic algorithms and data structures.', 'What is the purpose of a generator function in Python?\r\n', 'To create iterators', 'To handle exceptions', 'To define class methods', 'To create iterators'),
(9, 'Flutter 102', 'Intermediate', 'Flutter', 'IMG-646cff30e09d79.24761819.png', 'https://www.youtube.com/watch?v=1gDhl4leEzA&pp=ygUUZmx1dHRlciBjcmFzaCBjb3Vyc2U%3D', 'Advanced Flutter Development\" is an immersive course designed for experienced Flutter developers looking to expand their skills and delve deeper into the world of cross-platform app development. Building upon the foundational knowledge gained in Flutter 101, this course explores advanced topics and techniques that empower developers to create highly interactive and dynamic Flutter applications. Through comprehensive lessons and hands-on projects, you\'ll dive into advanced UI design patterns, state management approaches, asynchronous programming, integration with APIs and databases, animation and motion effects, and more. Flutter 102 equips you with the tools and knowledge to build complex, feature-rich apps that deliver exceptional user experiences across multiple platforms. Join Flutter 102 to take your Flutter expertise to new heights and become a proficient Flutter developer capable of tackling diverse and demanding app development projects.', 'Mobile app development concepts: Having a general understanding of mobile app development concepts, including user interfaces, app lifecycles, and basic navigation, will give you a solid foundation for learning Flutter.', 'What is the purpose of the \"Navigator\" class in Flutter?\r\n', 'It manages the state of a', 'It navigates between diff', 'It updates the user inter', 'It navigates between diff'),
(11, 'SQL 101', 'Beginner', 'SQL', 'IMG-646cffc17b4ba3.29507967.jpg', 'https://www.youtube.com/watch?v=h0nxCDiD-zg&pp=ygUHc3FsIDEwMQ%3D%3D', 'Introduction to Structured Query Language\" is a comprehensive course designed for beginners seeking to learn the fundamentals of SQL and relational database management. This course provides a solid foundation in understanding and working with databases using SQL, a standard language for interacting with relational databases. Through interactive lessons and practical examples, you\'ll learn essential concepts such as creating and managing databases, designing tables, querying data using SQL statements, and performing basic data manipulation operations like inserting, updating, and deleting records. SQL 101 is the perfect starting point for anyone interested in working with data and gaining valuable skills for data analysis, database management, and software development. Join SQL 101 to unlock the power of SQL and harness the potential of relational databases for your personal and professional projects.', 'Basic understanding of databases: Familiarity with the concept of databases, including the purpose and structure of a database, tables, columns, and rows, will provide a solid foundation for learning SQL. Understand how data is organized and stored in a database.', 'Which keyword is used to retrieve data from a database table in SQL?\r\n', 'UPDATE', 'INSERT', 'SELECT', 'SELECT');
COMMIT;

INSERT INTO `ADMINs` ( `email`, `pass`,`phone_number`) 
VALUES( 'mm@gmail.com', '45678910','97797959');


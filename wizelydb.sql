-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 08:46 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wizelydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lessonID` int(11) NOT NULL,
  `Category` varchar(20) NOT NULL,
  `lessonName` varchar(50) NOT NULL,
  `title1` varchar(50) NOT NULL,
  `title2` varchar(50) NOT NULL,
  `title3` varchar(50) NOT NULL,
  `title4` varchar(50) NOT NULL,
  `title5` varchar(50) NOT NULL,
  `description1` mediumtext NOT NULL,
  `description2` mediumtext NOT NULL,
  `description3` mediumtext NOT NULL,
  `description4` mediumtext NOT NULL,
  `description5` mediumtext NOT NULL,
  `info1` mediumtext NOT NULL,
  `info2` mediumtext NOT NULL,
  `info3` mediumtext NOT NULL,
  `info4` mediumtext NOT NULL,
  `info5` mediumtext NOT NULL,
  `example1` mediumtext NOT NULL,
  `example2` mediumtext NOT NULL,
  `example3` mediumtext NOT NULL,
  `example4` mediumtext NOT NULL,
  `example5` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lessonID`, `Category`, `lessonName`, `title1`, `title2`, `title3`, `title4`, `title5`, `description1`, `description2`, `description3`, `description4`, `description5`, `info1`, `info2`, `info3`, `info4`, `info5`, `example1`, `example2`, `example3`, `example4`, `example5`) VALUES
(1, 'HTML Lesson', 'HTML Headings', 'HTML Headings', 'Align HTML Heading', 'Add Heading Colors', '', '', 'HTML HeadingsHTML Headings usually contain a little or a main topic of a certain content.\r\nHTML Headings are block-levels elements.\r\nHTML Headings are ranked according to importance.', 'To align headings, we need to use the text-align CSS property with values left, center or right', 'To change the colors of our HTML Headings, we need to use inline styling with the CSS color property and a color value', '', '', '', '', '', '', '', '<h1>This is Heading 1</h1>\r\n<h2>This is Heading 2</h2>\r\n<h3>This is Heading 3</h3>\r\n<h4>This is Heading 4</h4>\r\n<h5>This is Heading 5</h5>\r\n<h6>This is Heading 6</h6>', '<h4 style=\"text-align: left\">I am aligned left.</h4>\r\n<h1 style=\"text-align: center\">I am aligned center.</h1>\r\n<h4 style=\"text-align: right\">I am aligned right.</h4>\r\n', '<h1 style=\"color: red\">I am Red.</h1>\r\n<h1 style=\"color: orange\">I am Orange.</h1>\r\n<h1 style=\"color: pink\">I am Pink.</h1>\r\n', '', ''),
(4, 'HTML Lesson', 'HTML Links', 'HTML Links (anchor tag &lt;a&gt;)', 'href', 'target ', 'download', 'id ', '', ' - to define the link’s destination address', 'specifies where to open the linked document\r\n', '- specifies that the target will be downloaded when a user clicks on the hyperlink', '- use # for href to hyperlink within the document', '', '', 'Values:\r\n_blank - opens the linked document in a new window or tab\r\n_parent - opens the linked document in the parent frame\r\n_self - opens the linked document in the same frame as it was clicked (this is default)\r\n_top - opens the linked document in the full body of th window', '', '', '', '<a href=\"index.php\" id=\"home\">Home</a>', '<a href=\"index.php\" target=\"_blank\">target=\"_blank\"</a>', '<a href=\"assets/image.jpg\" download>\r\nclick to download\r\n</a>', '<a href=\"#home\">Go to first example...</a>'),
(5, 'HTML Lesson', 'HTML Lists', 'HTML Lists', 'HTML Lists Elements', 'Nested HTML Lists', '', '', 'The elements below represent HTML Lists that can be used to group a Collection of items with and/or without order.', '', 'Sometimes we have to nest list to make the data we represent easier to understand.', '', '', '', '&lt;ul&gt; : defines an unordered list where the order is meaningless and is typically bulleted.\r\n&lt;ol&gt; : defines an ordered list where the order is meaningful and is typically numbered.\r\n&lt;li&gt; : a child element of both &lt;ul&gt; and &lt;ol&gt; elements that defines a list item.', '', '', '', '', '<!--Unordered List-->\r\n<p>Drinks</p>\r\n<ul>\r\n<li>Coffee</li>\r\n<li>Tea</li>\r\n<li>Milk</li>\r\n</ul>\r\n\r\n<!--Ordered List-->\r\n<p>Drinks</p>\r\n<ol>\r\n<li>Coffee</li>\r\n<li>Tea</li>\r\n<li>Milk</li>\r\n</p>\r\n', '<h6>Components of computers</h6>\r\n<ol>\r\n<li>Hardware</li>\r\n<ul>\r\n<li>Monitor</li>\r\n<li>Keyboard</li>\r\n<li>Mouse</li>\r\n</ul>\r\n<li>Software</li>\r\n<ul>\r\n<li>Application</li>\r\n<li>System</li>\r\n</ul>\r\n</ol>', '', ''),
(6, 'CSS Lesson', 'CSS Transitions', 'CSS Transitions', 'CSS Transition Timing Function', '', '', '', 'CSS Transitions allow us to control animation speed when changing CSS properties.\r\n\r\nCSS transitions can cause the changes in a defined property to take place over a period of time, instead of just taking place immediately.\r\n\r\n', 'The transition-timing-function CSS property sets the timing calculation of the transition effect.', '', '', '', 'We can demonstrate how transitions work with the :hover pseudo-class.', 'Valid Values:\r\nease: default, the transition effect starts slowly, then fast, then slowly ends\r\nlinear: the transition effect has the same speed from start to end\r\nease-in: the transition effect starts slowly\r\nease-out: the transition effect ends slowly\r\nease-in-out: the transition effect both starts and ends slowly', '', '', '', '<!--HTML-->\r\n<div id=\"div\" class=\"without-transition\">\r\nwithout transition\r\n</div>\r\n<div id=\"div\" class=\"with-transition\">\r\nwith transition\r\n</div>\r\nCSS code\r\n.without-transition{\r\nwidth: 80px;\r\nheight: 80px;\r\nbackground: black;\r\ntext-align: center;\r\ncolor: #ffffff;\r\n}\r\n.with-transition{\r\nwidth: 80px;\r\nheight: 80px;\r\nbackground: black;\r\ntext-align: cent', '<!--HTML Code-->\r\n<div id=\"div1\"></div>\r\nCSS Code\r\n#div1{\r\ntransition-timing-function: ease;\r\ntransition-property: width, background-color;\r\ntransition-duration: 2s;\r\nwidth: 100px;\r\nheight: 100px;\r\nbackground: blue;\r\n}\r\n#div1:hover{\r\nwidth: 200px;\r\nbackground: red;\r\n}', '', '', ''),
(7, 'CSS Lesson', 'CSS Animations', 'CSS Animations', 'The @keyframes Rule', '', '', '', 'CSS Animations animate HTML elements\' transitions from one style to another.\r\nWith CSS Animations we can animate elements without having to use (or know) JavaScript.', '', '', '', '', 'Animations have two components:\r\n1. A style describing the CSS animation.\r\n2. A set of keyframes that indicate the start intermediate waypoints and end states of the animation\'s styles', 'To use keyframes, create @keyframes rule with a name that is then used by the animation-name property to match an animation to its keyframe declaration. We also need to specify the duration of the animation using the animation-duration CSS property.', '', '', '', '', '<div id=\"div2\">\r\n</div>\r\nCSS Code Using @keyframes\r\n@keyframes myAnimation{\r\nfrom{\r\nbackground-color: gold;\r\ntop: 0px;\r\n}\r\nto{\r\nbackground-color: green;\r\ntop: 200px;\r\n}\r\n}\r\n#div2{\r\nanimation-name: myAnimation\r\nanimation-duration: 2s;\r\nposition: relative;\r\nwidth: 100px;\r\nheight: 100px;\r\nbackground-color: gold;\r\n}', '', '', ''),
(14, 'CSS Lesson', 'CSS Transforms', 'CSS 3D TRANSFORMS', 'The rotateX() Method', 'The rotateY() Method', '', '', 'A CSS transformation is an effect that changes an element’s size, shape and position.\r\nCSS supports 3D transforms.\r\n', 'Defines a transformation that rotates an element around the abscissa (x-axis or horizontal axis) without deforming it.\r\nThe value should be an angle.\r\n', 'Defines a transformation that rotates an element around the abscissa (y-axis or vertical axis) without deforming it.\r\nThe value should be an angle.\r\n', '', '', 'CSS 3D Transforms Methods\r\nrotateX()\r\nrotateY()\r\nrotateZ()\r\n', '', '', '', '', '', '<!--HTML Code-->\r\n<div class=\"rotatex\" style=\"background: black; color: white; width: 150px; height: 150px\">\r\ncopy CSS code to rotate me\r\n</div>\r\nCSS Code\r\n.rotatex{\r\ntransform: rotateX(140deg);\r\n}\r\n\r\n', '<!--HTML Code-->\r\n<div class=\"rotatey\" style=\"background: black; color: white; width: 150px; height: 150px\">\r\ncopy CSS code to rotate me\r\n</div>\r\nCSS Code\r\n.rotatey{\r\ntransform: rotateY(140deg);\r\n}\r\n', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quizrecords`
--

CREATE TABLE `quizrecords` (
  `ID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `Category` varchar(25) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizrecords`
--

INSERT INTO `quizrecords` (`ID`, `userId`, `Category`, `Name`, `Score`) VALUES
(1, 5, 'HTML Quiz', 'Karizza Tuan', 5),
(2, 5, 'CSS Quiz', 'Karizza Tuan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `qid` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`qid`, `category`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 'HTML Quiz', 'HTML stands for?', 'Hypertext Markup Language', 'High Text Markup Language', 'Hyper Tabular Markup language', 'None of the above', 'Hypertext Markup Language'),
(2, 'HTML Quiz', 'Which of the following tag is used to mark a beginning of paragraph &lt;_____&gt;?', 'td', 'br', 'p', 'tr', 'p'),
(3, 'HTML Quiz', 'Correct HTML tag for the largest heading is &lt;_____&gt;?', 'h7', 'h6', 'h1', 'h8', 'h1'),
(4, 'HTML Quiz', 'The following are examples of HTML text formatting tags except &lt;_____&gt;', 'bdo', 'mark', 'del', 'ins', 'bdo'),
(6, 'CSS Quiz', 'What does CSS stands for?', 'Creative Style Sheets', 'Colorful Style Sheets', 'Computer Style Sheets', 'Cascading Style Sheets', 'Cascading Style Sheets'),
(7, 'CSS Quiz', 'Which of the following does CSS not do?', 'lay-out', 'design', 'style', 'content', 'content'),
(8, 'CSS Quiz', '“a:hover” and “a:active” are both examples of what?', 'pseudo-classes', 'attribute selectors', 'id', 'pseudo-selectors', 'pseudo-classes'),
(11, 'CSS Quiz', 'Which method is ideal for applying the same style to an entire website?', 'Internal CSS', 'Inline CSS', 'External CSS', 'None of the above', 'Internal CSS'),
(13, 'CSS Quiz', 'A ___________ is used to define a special state of an element ', 'pseudo-tag ', 'pseudo-element ', 'pseudo-id ', 'pseudo-class', 'pseudo-class'),
(16, 'HTML Quiz', 'The page title is inside the ___ tag. ', 'body', 'head', 'div', 'table', 'head');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `description`, `image`, `file`) VALUES
(2, 'TASK 2', 'ORDERED & UNORDERED LIST', 'task2.png', ''),
(3, 'TASK 3', 'GLOSSARY', 'task3.png', 'task3.pdf'),
(5, 'TASK 4', 'FACEBOOK LOG IN FORM', 'task4.1.png', ''),
(7, 'TASK 5', 'PRICING TABLE', 'task6.png', 'task6.zip'),
(8, 'TASK 1', 'ABOUT ME', 'task1.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `acct_type` varchar(20) NOT NULL,
  `profile_pic` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `acct_type`, `profile_pic`) VALUES
(1, 'Britney Grace S. Calulot', 'britneygrace@mail.com', 'britney', 'Admin', ''),
(2, 'Kristina Maguddayao', 'mkristina@gmail.com', '@kristinaWizely', 'Admin', ''),
(3, 'Viverlyn Uberita', 'vivuberita@gmail.com', '@viverlynWizely', 'Admin', ''),
(5, 'Karizza Tuan', 'karizzamae@gmail.com', 'kakay', 'User', ''),
(6, 'Princess Mae', 'princessmae@gmail.com', 'princess', 'User', ''),
(7, 'Leyra Erica S. Talamayan', 'tleyra@gmail.com', 'leyra', 'User', ''),
(8, 'Susana Marie', 'susanamarie@gmail.com', 'susana', 'User', ''),
(11, 'Pierra Calasanz', 'pierra@email.com', 'iampierra', 'User', ''),
(12, 'Smith Johnson', 'mrsmith@gmail.com', 'smith101', 'User', ''),
(13, 'Johnny Doe', 'iamjohnny@gmail.com', 'johnnydoe', 'User', ''),
(14, 'Juan McArthur', 'iamone@gmail.com', 'juam', 'User', ''),
(17, 'Maria Angela', 'mariaangela@gmail.com', 'mariya', 'User', ''),
(26, 'Choi Hyunsuk', 'hyunsuk@gmail.com', 'hyunsuk', 'User', 'hyunsuk.jpg'),
(30, 'Stela Marie Cabalza', 'cstela@gmail.com', '@stelaWizely', 'Admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonID`);

--
-- Indexes for table `quizrecords`
--
ALTER TABLE `quizrecords`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quizrecords`
--
ALTER TABLE `quizrecords`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

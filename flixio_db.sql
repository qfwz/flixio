-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for flixio_db
CREATE DATABASE IF NOT EXISTS `flixio_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `flixio_db`;

-- Dumping structure for table flixio_db.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `year` year DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `description` varchar(2047) DEFAULT 'No description.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table flixio_db.movies: ~35 rows (approximately)
INSERT INTO `movies` (`id`, `title`, `year`, `genre`, `poster`, `description`) VALUES
	(1, 'Inception', '2010', 'Sci-Fi', 'https://image.tmdb.org/t/p/original/xlaY2zyzMfkhk0HSC5VUwzoZPU1.jpg', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO, but his tragic past may doom the project and his team to disaster.'),
	(2, 'Interstellar', '2014', 'Sci-Fi', 'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', 'The adventures of a group of explorers who make use of a newly discovered wormhole to surpass the limitations on human space travel and conquer the vast distances involved in an interstellar voyage.'),
	(3, 'RRR', '2022', 'Action', 'https://image.tmdb.org/t/p/original/nEufeZlyAOLqO2brrs0yeF1lgXO.jpg', 'A fearless warrior on a perilous mission comes face to face with a steely cop serving British forces in this epic saga set in pre-independent India.'),
	(4, 'Parasite', '2019', 'Thriller', 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', 'No description.'),
	(5, 'The Raid', '2011', 'Action', 'https://image.tmdb.org/t/p/w500/6d5XOczc226jECq0LIX0siKtgHR.jpg', 'No description.'),
	(6, 'Spirited Away', '2001', 'Fantasy', 'https://image.tmdb.org/t/p/w500/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg', 'No description.'),
	(7, 'Amélie', '2001', 'Romance', 'https://image.tmdb.org/t/p/original/nSxDa3M9aMvGVLoItzWTepQ5h5d.jpg', 'No description.'),
	(8, 'A Separation', '2011', 'Drama', 'https://image.tmdb.org/t/p/original/xQadpnoLokxzN3hRpCPbBGpxsiz.jpg', 'No description.'),
	(9, 'City of God', '2002', 'Crime', 'https://image.tmdb.org/t/p/original/k7eYdWvhYQyRQoU2TB2A2Xu2TfD.jpg', 'No description.'),
	(10, 'Your Name', '2016', 'Romance', 'https://image.tmdb.org/t/p/w500/q719jXXEzOoYaps6babgKnONONX.jpg', 'No description.'),
	(11, 'Train to Busan', '2016', 'Horror', 'https://image.tmdb.org/t/p/w500/3H1WFCuxyNRP35oiL2qqwhAXxc0.jpg', 'No description.'),
	(12, 'Slumdog Millionaire', '2008', 'Drama', 'https://image.tmdb.org/t/p/w500/5leCCi7ZF0CawAfM5Qo2ECKPprc.jpg', 'No description.'),
	(13, 'Pan\'s Labyrinth', '2006', 'Fantasy', 'https://image.tmdb.org/t/p/original/z7xXihu5wHuSMWymq5VAulPVuvg.jpg', 'In 1944 Francoist Spain, an imaginative young girl meets a faun who tells her she\'s a princess and that she must prove her worthiness by completing three dangerous tasks.'),
	(14, 'The Intouchables', '2011', 'Drama', 'https://image.tmdb.org/t/p/original/1QU7HKgsQbGpzsJbJK4pAVQV9F5.jpg', 'No description.'),
	(15, 'Oldboy', '2003', 'Thriller', 'https://image.tmdb.org/t/p/w500/pWDtjs568ZfOTMbURQBYuT4Qxka.jpg', 'No description.'),
	(16, 'Life Is Beautiful', '1997', 'Drama', 'https://image.tmdb.org/t/p/w500/74hLDKjD5aGYOotO6esUVaeISa2.jpg', 'No description.'),
	(17, 'Crouching Tiger, Hidden Dragon', '2000', 'Action', 'https://image.tmdb.org/t/p/original/iNDVBFNz4XyYzM9Lwip6atSTFqf.jpg', 'No description.'),
	(18, 'The Platform', '2019', 'Sci-Fi', 'https://image.tmdb.org/t/p/original/iXvQnzy6JCAx1PiQEKXuTY04ZHl.jpg', 'No description.'),
	(19, 'The Handmaiden', '2016', 'Thriller', 'https://www.themoviedb.org/t/p/w1280/dLlH4aNHdnmf62umnInL8xPlPzw.jpg', 'No description.'),
	(20, 'Burning', '2018', 'Drama', 'https://www.themoviedb.org/t/p/w1280/kXiF80o74fE9gf3Utf9moAI7ar0.jpg', 'No description.'),
	(21, 'Shoplifters', '2018', 'Drama', 'https://image.tmdb.org/t/p/w500/4nfRUOv3LX5zLn98WS1WqVBk9E9.jpg', 'No description.'),
	(22, 'Drive My Car', '2021', 'Drama', 'https://image.tmdb.org/t/p/w500/8j58iEBw9pOXFD2L0nt0ZXeHviB.jpg', 'No description.'),
	(23, 'Decision to Leave', '2022', 'Romance', 'https://image.tmdb.org/t/p/w500/8Vt6mWEReuy4Of61Lnj5Xj704m8.jpg', 'No description.'),
	(24, 'Your Name Engraved Herein', '2020', 'Romance', 'https://www.themoviedb.org/t/p/w1280/ynNO5FhArEz68wRKOn4NgqVntmS.jpg', 'No description.'),
	(25, 'The Wailing', '2016', 'Horror', 'https://www.themoviedb.org/t/p/w1280/aXlL7yYwpXInhltamtzKQFBG08G.jpg', 'No description.'),
	(26, 'Memories of Murder', '2003', 'Crime', 'https://www.themoviedb.org/t/p/w1280/dsEoTJKM1s5OVDkS2P2JdoTxo4K.jpg', 'No description.'),
	(27, 'I Saw the Devil', '2010', 'Thriller', 'https://www.themoviedb.org/t/p/w1280/zp5NrmYp80axIGiEiYPmm1CW6uH.jpg', 'No description.'),
	(28, 'The Hunt', '2012', 'Drama', 'https://www.themoviedb.org/t/p/w1280/jkixsXzRh28q3PCqFoWcf7unghT.jpg', 'A teacher lives a lonely life, all the while struggling over his son\'s custody. His life slowly gets better as he finds love and receives good news from his son, but his new luck is about to be brutally shattered by an innocent little lie.'),
	(29, 'Another Round', '2020', 'Drama', 'https://www.themoviedb.org/t/p/w1280/aDcIt4NHURLKnAEu7gow51Yd00Q.jpg', 'No description.'),
	(30, 'Portrait of a Lady on Fire', '2019', 'Romance', 'https://www.themoviedb.org/t/p/w1280/2LquGwEhbg3soxSCs9VNyh5VJd9.jpg', 'No description.'),
	(39, 'Drive My Car', '2021', 'Drama', 'https://image.tmdb.org/t/p/original/a2lxHS6Au35k5XtFQEQW44yWHeH.jpg', 'No description.'),
	(41, 'Monster', '2023', 'Drama', 'https://image.tmdb.org/t/p/original/kvUJUyUGOhEoiWWNH04IXoExPE2.jpg', 'After an outburst at school involving her son, a concerned single mother demands answers, triggering a sequence of deepening suspicion and turmoil.'),
	(49, 'Kaithi', '2019', 'Action', 'https://image.tmdb.org/t/p/original/uI6pO52MZ5zElby4Jn2pL2xZT9E.jpg', 'Dilli, a convicted criminal, is out on parole to meet his daughter. However, a drug bust sets him off on a mission to save the life of police officers.'),
	(50, 'Jembatan Shiratal Mustaqim', '2025', 'Horror', 'https://image.tmdb.org/t/p/original/pvmnrIov0uKlPmcrABOaCa7ucud.jpg', 'After the tsunami disaster and rumors of aid fund embezzlement, Arya is frequently terrorized by visions of a place believed to be the Shiratal Mustaqim bridge — the dreaded bridge in the afterlife that connects to heaven and stretches over hell. Arya and his mother then try to investigate the connection between the embezzlement and the Shiratal Mustaqim bridge. However, their pursuit comes at the cost of their lives.'),
	(51, 'Sherina\'s Adventure', '2000', 'Musical', 'https://image.tmdb.org/t/p/original/jOEj8TNCuxvnxowjmW2TFrVycC4.jpg', 'A girl who struggles at her new school must team up with a classmate giving her major headaches when trouble finds them both in this musical adventure.');

-- Dumping structure for table flixio_db.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `review` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table flixio_db.reviews: ~9 rows (approximately)
INSERT INTO `reviews` (`id`, `movie_id`, `username`, `rating`, `review`, `created_at`) VALUES
	(1, 3, 'admin', 10, 'I LOVE THIS MOVIE SO MUCH', '2026-04-25 23:37:18'),
	(2, 39, 'admin', 8, 'this movie is 3 hours long, not for everyone', '2026-04-26 00:15:15'),
	(3, 3, 'user', 8, 'my first telugu movie and im loving every second of it', '2026-04-26 04:03:46'),
	(5, 2, 'admin', 10, '', '2026-04-26 06:34:30'),
	(6, 2, 'user', 9, 'this is my favorite movie from christopher nolan', '2026-04-26 06:37:27'),
	(7, 49, 'admin', 10, 'the best action movie i have ever watched', '2026-04-26 11:47:52'),
	(9, 50, 'admin', 1, 'worst of the worst. wouldn\'t wish this kinda media on my worst enemy. irredeemable piece of radioactive trash, avoid at ALL COST.', '2026-04-26 11:55:04'),
	(12, 41, 'admin', 0, 'i love this movie a lot <3', '2026-04-26 12:05:45'),
	(13, 13, 'admin', 10, '', '2026-04-26 14:45:39'),
	(14, 8, 'admin', 10, '', '2026-04-26 15:04:27');

-- Dumping structure for table flixio_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table flixio_db.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
	(1, 'admin', 'admin@flixio.local', '$2y$10$rRTxSYmkVo77T36XydMNs.XA6C0GQtUcQVrFLWHvyCk1of/5XV5Qe', 'admin', '2026-04-25 06:31:52'),
	(2, 'user', 'user@email.com', '$2y$10$jFODWCycZBmlNoRsCA2N4uZViTmMXadP8jUGjbrLiW6.y5fkxrm6e', 'user', '2026-04-25 06:33:35');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

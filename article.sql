



CREATE TABLE `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int NOT NULL,
  `author_id` int NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),

    FOREIGN KEY (`category_id`) REFERENCES `category` (`CategoryID`) ON DELETE CASCADE,
   FOREIGN KEY (`author_id`) REFERENCES `utilisateurs` (`utilisateurID`) ON DELETE CASCADE;

);
-- 

INSERT INTO `article` (`id`, `title`, `content`, `category_id`, `author_id`, `status`, `created_at`, `image`) VALUES
(1, 'Doloremque ', 'Irure corrupti veliIrure corrupti veliIrure corrupti veliIrure corrupti veliIrure corrupti veliIrure corrupti veli', 70, 1121, 'approved', '2025-01-03 22:31:42', '../upload/296d562864.jpeg'),
(2, 'Ea quia ut qui nihil', 'Et exercitationem ad', 70, 1121, 'approved', '2025-01-03 22:31:54', '../upload/fbdf69f9e2.webp');


-- 
CREATE TABLE `category` (
  `CategoryID` int NOT NULL AUTO_INCREMENT,
  `names` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `description` text,
  PRIMARY KEY (`CategoryID`)
);
-- 
INSERT INTO `category` (`CategoryID`, `names`, `created_at`, `description`) VALUES
(70, 'Art Traditionnelle', '2025-01-03 23:28:54', NULL),
(71, 'Musique du Monde', '2025-01-03 23:28:54', NULL);

CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `article_id` int NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`utilisateurID`),
    FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);
);

INSERT INTO `comments` (`id`, `user_id`, `article_id`, `comment_text`, `comment_date`) VALUES
(3, 1127, 208, 'Laborum Hic amet e', '2025-01-04 16:11:18'),
(4, 1127, 208, 'Laborum Hic amet e', '2025-01-04 16:12:49');

CREATE TABLE `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `content_id` int NOT NULL,
  `like_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
     FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`utilisateurID`),
     FOREIGN KEY (`content_id`) REFERENCES `article` (`id`);

);

INSERT INTO `likes` (`id`, `user_id`, `content_id`, `like_date`) VALUES
(49, 1121, 205, '2025-01-04 00:18:40'),
(52, 1121, 207, '2025-01-04 00:25:36');


CREATE TABLE `utilisateurs` (
  `utilisateurID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','auteur','user') NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `archived` int DEFAULT '0',
  PRIMARY KEY (`utilisateurID`)
);

INSERT INTO `utilisateurs` (`utilisateurID`, `name`, `email`, `password`, `role`, `created_date`, `archived`) VALUES
(10, 'Kim Solomon', 'dajypyheby@mailinator.com', '$2y$10$W.0WUWEBHiQ0KA78ecDPbuq9XC.usky2.CTTBgFhFgw6AMpxkaBLW', 'user', '2024-12-31 10:08:43', 0),
(11, 'Moustir Mohamed', 'itsmoustir@gmail.com', '$2y$10$Pal8PVAoKyRP9gD8ddsEveJFcirBB1V7LN/CBQTQ/BYuN44llfova', 'auteur', '2024-12-31 10:10:31', 0);





--  1 Trouver le nombre total d'articles publiés par catégorie.

SELECT category.names , COUNT(article.id)  FROM article 
JOIN category on article.category_id = category.CategoryID
GROUP BY category.names ;
-- 2 Identifier les auteurs les plus actifs en fonction du nombre d'articles publiés.

SELECT utilisateurs.name , COUNT(article.id)  FROM article 
JOIN utilisateurs on article.author_id = utilisateurs.utilisateurID
GROUP by utilisateurs.utilisateurID;
-- 3 Calculer la moyenne d'articles publiés par catégorie.

SELECT category.names, AVG(article_count) AS average_articles_per_category
FROM (
    SELECT category_id, COUNT(id) AS article_count
    FROM article
    GROUP BY category_id
) AS category_counts
JOIN category ON category.CategoryID = category_counts.category_id
GROUP BY category.names;


-- 4 Créer une vue affichant les derniers articles publiés dans les 30 derniers jours.

CREATE VIEW derniers_articles AS
SELECT a.id, a.title, a.content, a.created_at, c.names AS category_name, u.name AS author_name
FROM article a
JOIN category c ON a.category_id = c.CategoryID
JOIN utilisateurs u ON a.author_id = u.utilisateurID
WHERE a.created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
ORDER BY a.created_at DESC;

-- 5 Trouver les catégories qui n'ont aucun article associé

SELECT category.names FROM `category` 
LEFT JOIN article on category.CategoryID = article.category_id
WHERE article.category_id is null
GROUP by category.names
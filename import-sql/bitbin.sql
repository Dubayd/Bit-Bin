-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 jul 2023 om 09:11
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitbin`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pastes`
--

CREATE TABLE `pastes` (
  `id` mediumint(9) NOT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  `code` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `expiration` datetime DEFAULT NULL,
  `syntax` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `pastes`
--

INSERT INTO `pastes` (`id`, `unique_id`, `code`, `category`, `expiration`, `syntax`) VALUES
(1, '64a72ff78ebb0', '  <div class=\"container\">\r\n        <div class=\"row justify-content-center mt-4\">\r\n            <div class=\"col-md-8\">\r\n                <form method=\"POST\" action=\"view.php?id=<?php echo $id; ?>\">\r\n                    <div class=\"form-group\">\r\n                        <label for=\"codeArea\">Copy it!</label>\r\n                        <textarea class=\"form-control\" id=\"code\" name=\"codeArea\" rows=\"10\" readonly><?php echo $code; ?></textarea>\r\n                    </div>\r\n                    <div class=\"form-group\">\r\n                        <button type=\"button\" onclick=\"copyToClipboard()\" class=\"btn btn-primary\">Share</button>\r\n                    </div>\r\n                </form>\r\n            </div>\r\n        </div>\r\n    </div>', 'Code', '2023-07-07 00:19:51', 'HTML'),
(2, '64a73082c1bde', '  <div class=\"container\">\r\n        <div class=\"row justify-content-center mt-4\">\r\n            <div class=\"col-md-8\">\r\n                <form method=\"POST\" action=\"view.php?id=<?php echo $id; ?>\">\r\n                    <div class=\"form-group\">\r\n                        <label for=\"codeArea\">Copy it!</label>\r\n                        <textarea class=\"form-control\" id=\"code\" name=\"codeArea\" rows=\"10\" readonly><?php echo $code; ?></textarea>\r\n                    </div>\r\n                    <div class=\"form-group\">\r\n                        <button type=\"button\" onclick=\"copyToClipboard()\" class=\"btn btn-primary\">Share</button>\r\n                    </div>\r\n                </form>\r\n            </div>\r\n        </div>\r\n    </div>', 'Code', '2023-07-06 23:32:10', 'HTML'),
(3, '64a730d7232d0', ' echo $geshi->parse_code();', 'Code', '2023-07-06 23:33:35', 'PHP'),
(4, '64a730f9a49ba', ' echo $geshi->parse_code();', 'Code', '2023-07-06 23:34:09', 'PHP'),
(5, '64a731cd1f9ac', ' <div class=\"container\">\r\n        <div class=\"row justify-content-center mt-4\">\r\n            <div class=\"col-md-8\">\r\n                <form method=\"POST\" action=\"view.php?id=<?php echo $id; ?>\">\r\n                    <div class=\"form-group\">\r\n                        <label for=\"codeArea\">Copy it!</label>\r\n                        <!-- <textarea class=\"form-control\" id=\"code\" name=\"codeArea\" rows=\"10\" readonly><?php echo $geshi->parse_code(); ?></textarea> -->\r\n                        <?php echo $geshi->parse_code(); ?>\r\n                    </div>\r\n                    <div class=\"form-group\">\r\n                        <button type=\"button\" onclick=\"copyToClipboard()\" class=\"btn btn-primary\">Share</button>\r\n                    </div>\r\n                </form>\r\n            </div>\r\n        </div>\r\n    </div>\r\n', 'Code', '2023-07-06 23:37:41', 'HTML'),
(6, '64a7326b3cfde', ' <div class=\"container\">\r\n        <div class=\"row justify-content-center mt-4\">\r\n            <div class=\"col-md-8\">\r\n                <form method=\"POST\" action=\"view.php?id=<?php echo $id; ?>\">\r\n                    <div class=\"form-group\">\r\n                        <label for=\"codeArea\">Copy it!</label>\r\n                        <!-- <textarea class=\"form-control\" id=\"code\" name=\"codeArea\" rows=\"10\" readonly><?php echo $geshi->parse_code(); ?></textarea> -->\r\n                        <?php echo $geshi->parse_code(); ?>\r\n                    </div>\r\n                    <div class=\"form-group\">\r\n                        <button type=\"button\" onclick=\"copyToClipboard()\" class=\"btn btn-primary\">Share</button>\r\n                    </div>\r\n                </form>\r\n            </div>\r\n        </div>\r\n    </div>\r\n', 'Code', '2023-07-06 23:40:19', 'HTML'),
(7, '64a7b9bd5218c', '// Check if the paste ID is provided in the URL\r\n    if (isset($_GET[\'id\'])) {\r\n        $id = $_GET[\'id\'];\r\n\r\n        // Retrieve the paste from the database\r\n        $stmt = $conn->prepare(\"SELECT * FROM pastes WHERE unique_id = :id\");\r\n        $stmt->bindParam(\':id\', $id);\r\n        $stmt->execute();\r\n        $paste = $stmt->fetch(PDO::FETCH_ASSOC);\r\n\r\n        $syntax = $paste[\'syntax\'];\r\n\r\n        // check which language is being pasted \r\n        if ($syntax == \"PHP\") {\r\n            $source = $paste[\'code\'];\r\n            $language = \"php\";\r\n\r\n            $geshi = new GeSHi($source, $language);\r\n        } elseif ($syntax == \"HTML\") {\r\n            $source = $paste[\'code\'];\r\n            $language = \"html5\";\r\n\r\n            $geshi = new GeSHi($source, $language);\r\n        }\r\n\r\n        // Check if a paste with the given ID exists\r\n        if ($paste) {\r\n            $code = $paste[\'code\'];\r\n\r\n            // Check if the paste has expired\r\n            $expirationDateTime = $paste[\'expiration\'];\r\n            $currentDateTime = date(\'Y-m-d H:i:s\');\r\n            if ($expirationDateTime <= $currentDateTime) {\r\n                // The paste has expired\r\n                echo \"This paste has expired.<br>\";\r\n                echo \"Redirecting in 3 seconds\";\r\n                header(\"refresh:3;url=index.php\");\r\n                exit();\r\n            }\r\n        } else {\r\n            // Handle the case when the paste does not exist\r\n            echo \"Paste not found.\";\r\n            exit();\r\n        }\r\n    } else {\r\n        // Handle the case when no paste ID is provided\r\n        echo \"No paste ID provided.\";\r\n        exit();\r\n    }', 'Code', '2023-07-07 09:17:41', 'PHP');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `pastes`
--
ALTER TABLE `pastes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `pastes`
--
ALTER TABLE `pastes`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

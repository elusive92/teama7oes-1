-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Paź 2014, 10:53
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `teama7oes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `blacklists`
--

CREATE TABLE IF NOT EXISTS `blacklists` (
`idblock` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `idB` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `blacklists`:
--   `idA`
--       `users` -> `id`
--   `idB`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
`idcon` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `idB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `conversations`:
--   `idA`
--       `users` -> `id`
--   `idB`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
`idphoto` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `filename` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `galleries`:
--   `id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE IF NOT EXISTS `games` (
`idgame` int(11) NOT NULL,
  `gamename` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `logo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
`idmatch` int(11) NOT NULL,
  `idtournament` int(11) NOT NULL,
  `idteamA` int(11) NOT NULL,
  `idteamB` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `result` int(1) NOT NULL,
  `round` int(10) NOT NULL,
  `bracket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `matches`:
--   `idtournament`
--       `tournaments` -> `idtournament`
--   `idteamA`
--       `teams` -> `idteam`
--   `idteamB`
--       `teams` -> `idteam`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matchresult`
--

CREATE TABLE IF NOT EXISTS `matchresult` (
  `idmatch` int(11) NOT NULL,
  `resultA` int(1) DEFAULT NULL,
  `resultB` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- RELACJE TABELI `matchresult`:
--   `idmatch`
--       `matches` -> `idmatch`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `matchsquad`
--

CREATE TABLE IF NOT EXISTS `matchsquad` (
  `idmatch` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- RELACJE TABELI `matchsquad`:
--   `idteam`
--       `teams` -> `idteam`
--   `id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `idcon` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `senddate` datetime NOT NULL,
  `recivedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- RELACJE TABELI `messages`:
--   `idcon`
--       `conversations` -> `idcon`
--   `idA`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`idnews` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `photo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `news`:
--   `idgame`
--       `games` -> `idgame`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `players`
--

CREATE TABLE IF NOT EXISTS `players` (
`idplayer` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nickname` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `players`:
--   `idgame`
--       `games` -> `idgame`
--   `id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teamgalleries`
--

CREATE TABLE IF NOT EXISTS `teamgalleries` (
`idtphoto` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `filename` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teamgalleries`:
--   `idteam`
--       `teams` -> `idteam`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teaminvitations`
--

CREATE TABLE IF NOT EXISTS `teaminvitations` (
`idinv` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teaminvitations`:
--   `idteam`
--       `teams` -> `idteam`
--   `id`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teammembers`
--

CREATE TABLE IF NOT EXISTS `teammembers` (
`idteammember` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `joindate` datetime NOT NULL,
  `leftdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teammembers`:
--   `id`
--       `users` -> `id`
--   `idteam`
--       `teams` -> `idteam`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
`idteam` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `teamname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `logo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL,
  `ranking` int(5) NOT NULL DEFAULT '1000',
  `win` int(4) NOT NULL DEFAULT '0',
  `lose` int(4) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `teams`:
--   `id`
--       `users` -> `id`
--   `idgame`
--       `games` -> `idgame`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tournamentmembers`
--

CREATE TABLE IF NOT EXISTS `tournamentmembers` (
  `idtournament` int(11) NOT NULL,
  `idteam` int(11) NOT NULL,
  `position` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- RELACJE TABELI `tournamentmembers`:
--   `idteam`
--       `teams` -> `idteam`
--   `idtournament`
--       `tournaments` -> `idtournament`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
`idtournament` int(11) NOT NULL,
  `idgame` int(11) NOT NULL,
  `numberofteams` int(5) NOT NULL,
  `numberofplayers` int(2) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `descript` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `regdate` datetime NOT NULL,
  `startdate` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- RELACJE TABELI `tournaments`:
--   `idgame`
--       `games` -> `idgame`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `password_temp` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `code` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `active` int(11) NOT NULL,
  `permissions` int(1) NOT NULL DEFAULT '0',
  `about` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo` varchar(20) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `blacklists`
--
ALTER TABLE `blacklists`
 ADD PRIMARY KEY (`idblock`), ADD KEY `idA` (`idA`), ADD KEY `idB` (`idB`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
 ADD PRIMARY KEY (`idcon`), ADD KEY `idA` (`idA`), ADD KEY `idB` (`idB`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
 ADD PRIMARY KEY (`idphoto`), ADD KEY `id` (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`idgame`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
 ADD PRIMARY KEY (`idmatch`), ADD KEY `idtournament` (`idtournament`), ADD KEY `idteamA` (`idteamA`), ADD KEY `idteamB` (`idteamB`);

--
-- Indexes for table `matchresult`
--
ALTER TABLE `matchresult`
 ADD KEY `idmatch` (`idmatch`);

--
-- Indexes for table `matchsquad`
--
ALTER TABLE `matchsquad`
 ADD KEY `idteam` (`idteam`), ADD KEY `id` (`id`), ADD KEY `idteam_2` (`idteam`), ADD KEY `id_2` (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD KEY `idA` (`idA`), ADD KEY `idcon` (`idcon`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`idnews`), ADD KEY `idgame` (`idgame`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
 ADD PRIMARY KEY (`idplayer`), ADD KEY `idgame` (`idgame`), ADD KEY `id` (`id`);

--
-- Indexes for table `teamgalleries`
--
ALTER TABLE `teamgalleries`
 ADD PRIMARY KEY (`idtphoto`), ADD KEY `idteam` (`idteam`);

--
-- Indexes for table `teaminvitations`
--
ALTER TABLE `teaminvitations`
 ADD PRIMARY KEY (`idinv`), ADD KEY `idteam` (`idteam`), ADD KEY `id` (`id`);

--
-- Indexes for table `teammembers`
--
ALTER TABLE `teammembers`
 ADD PRIMARY KEY (`idteammember`), ADD KEY `id` (`id`), ADD KEY `idteam` (`idteam`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
 ADD PRIMARY KEY (`idteam`), ADD KEY `id` (`id`), ADD KEY `idgame` (`idgame`);

--
-- Indexes for table `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
 ADD KEY `idteam` (`idteam`), ADD KEY `idtournament` (`idtournament`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
 ADD PRIMARY KEY (`idtournament`), ADD KEY `idgame` (`idgame`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `blacklists`
--
ALTER TABLE `blacklists`
MODIFY `idblock` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `conversations`
--
ALTER TABLE `conversations`
MODIFY `idcon` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `galleries`
--
ALTER TABLE `galleries`
MODIFY `idphoto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `matches`
--
ALTER TABLE `matches`
MODIFY `idmatch` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
MODIFY `idnews` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `players`
--
ALTER TABLE `players`
MODIFY `idplayer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teamgalleries`
--
ALTER TABLE `teamgalleries`
MODIFY `idtphoto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teaminvitations`
--
ALTER TABLE `teaminvitations`
MODIFY `idinv` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teammembers`
--
ALTER TABLE `teammembers`
MODIFY `idteammember` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `teams`
--
ALTER TABLE `teams`
MODIFY `idteam` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `tournaments`
--
ALTER TABLE `tournaments`
MODIFY `idtournament` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `blacklists`
--
ALTER TABLE `blacklists`
ADD CONSTRAINT `blacklists_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `blacklists_ibfk_2` FOREIGN KEY (`idB`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `conversations`
--
ALTER TABLE `conversations`
ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`idB`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `galleries`
--
ALTER TABLE `galleries`
ADD CONSTRAINT `galleries_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `matches`
--
ALTER TABLE `matches`
ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`idtournament`) REFERENCES `tournaments` (`idtournament`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`idteamA`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`idteamB`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `matchresult`
--
ALTER TABLE `matchresult`
ADD CONSTRAINT `matchresult_ibfk_1` FOREIGN KEY (`idmatch`) REFERENCES `matches` (`idmatch`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `matchsquad`
--
ALTER TABLE `matchsquad`
ADD CONSTRAINT `matchsquad_ibfk_1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `matchsquad_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`idcon`) REFERENCES `conversations` (`idcon`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`idA`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`idgame`) REFERENCES `games` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `players`
--
ALTER TABLE `players`
ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`idgame`) REFERENCES `games` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teamgalleries`
--
ALTER TABLE `teamgalleries`
ADD CONSTRAINT `teamgalleries_ibfk_1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teaminvitations`
--
ALTER TABLE `teaminvitations`
ADD CONSTRAINT `teaminvitations_ibfk_1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teaminvitations_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teammembers`
--
ALTER TABLE `teammembers`
ADD CONSTRAINT `teammembers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teammembers_ibfk_2` FOREIGN KEY (`idteam`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `teams`
--
ALTER TABLE `teams`
ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`idgame`) REFERENCES `games` (`idgame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tournamentmembers`
--
ALTER TABLE `tournamentmembers`
ADD CONSTRAINT `tournamentmembers_ibfk_1` FOREIGN KEY (`idteam`) REFERENCES `teams` (`idteam`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tournamentmembers_ibfk_2` FOREIGN KEY (`idtournament`) REFERENCES `tournaments` (`idtournament`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tournaments`
--
ALTER TABLE `tournaments`
ADD CONSTRAINT `tournaments_ibfk_1` FOREIGN KEY (`idgame`) REFERENCES `games` (`idgame`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

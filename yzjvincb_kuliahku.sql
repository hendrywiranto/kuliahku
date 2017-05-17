--
-- Database: `yzjvincb_kuliahku`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_cara_tugas`$$
CREATE PROCEDURE `sp_cara_tugas` (`p_nama_tugas` VARCHAR(191))  BEGIN
	IF EXISTS(SELECT 1 FROM tugas WHERE nama_tugas = p_nama_tugas) THEN
		SELECT
		    `tugas`.`nama_tugas`
		    ,`caras`.`knowledge_juml`
		    , `caras`.`moral_juml`
		    , `caras`.`completion_time`
		    , `caras`.`energi_req`
		    , `caras`.`nama_cara`
		FROM
		    `yzjvincb_kuliahku`.`caras`
		    INNER JOIN `yzjvincb_kuliahku`.`tugas` 
			ON (`caras`.`id_tugas` = `tugas`.`id`)
		where nama_tugas=p_nama_tugas;
	ELSE
		SELECT -1, 'Tugas tidak ada';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_daftar`$$
CREATE PROCEDURE `sp_daftar` (`p_nama` VARCHAR(32), `p_email` VARCHAR(32), `p_password` VARCHAR(32))  BEGIN
	IF NOT EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		IF NOT EXISTS(SELECT 1 FROM users WHERE p_nama = u_name) THEN
			INSERT INTO users(u_name, u_email, u_password)
			VALUES	(p_nama, p_email, MD5(p_password));
			SELECT 0, 'pendaftaran sukses!';
		ELSE
			SELECT -2, 'username sudah ada';
		END IF;
	ELSE
		SELECT -1, 'pendaftaran gagal! email sudah digunakan';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login` (`p_email` VARCHAR(32), `p_password` VARCHAR(32))  BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE p_email = u_email) THEN
		IF EXISTS(SELECT 2 FROM users WHERE MD5(p_password) = u_password AND p_email = u_email) THEN
			SELECT 0,'Login sukes', (SELECT id FROM users WHERE p_email = u_email) AS user_id;
		ELSE
			SELECT -2,'Password salah';
		END IF;
	ELSE
		SELECT -1,'Username tidak ada';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_masuk_tugas`$$
CREATE PROCEDURE `sp_masuk_tugas` (`p_email` VARCHAR(191), `p_id_tugas` INT(10))  BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) and (select 1 from tugas where id = p_id_tugas) THEN
		set @userid = (SELECT id FROM users WHERE u_email = p_email);
		insert into user_tugas (
			user_id, id_tugas
		) values ( @userid, p_id_tugas );
		select 1, 'Berhasil';
	ELSE
		SELECT -1, 'email tidak ada';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_matkul_list`$$
CREATE PROCEDURE `sp_matkul_list` (`p_email` VARCHAR(191))  BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		    `mata_kuliahs`.`nama_matkul`
		FROM
		    `yzjvincb_kuliahku`.`user_matkul`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`user_matkul`.`user_id` = `users`.`id`)
		    INNER JOIN `yzjvincb_kuliahku`.`mata_kuliahs` 
			ON (`user_matkul`.`matkul_id` = `mata_kuliahs`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_tugas_available`$$
CREATE PROCEDURE `sp_tugas_available` ()  BEGIN
	SELECT
	    `nama_tugas`
	FROM
	    `yzjvincb_kuliahku`.`tugas`;
    END$$

DROP PROCEDURE IF EXISTS `sp_tugas_list`$$
CREATE PROCEDURE `sp_tugas_list` (`p_email` VARCHAR(191))  BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		   `tugas`.`nama_tugas`
		FROM
		    `yzjvincb_kuliahku`.`user_tugas`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`user_tugas`.`user_id` = `users`.`id`)
		    INNER JOIN `yzjvincb_kuliahku`.`tugas` 
			ON (`user_tugas`.`id_tugas` = `tugas`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END$$

DROP PROCEDURE IF EXISTS `sp_user_statistik`$$
CREATE PROCEDURE `sp_user_statistik` (`p_email` VARCHAR(191))  BEGIN
	IF EXISTS(SELECT 1 FROM users WHERE u_email = p_email) THEN
		SELECT
		    1 as ind
		    , `users`.`u_name`
		    , `users`.`u_email`
		    , `statistiks`.`knowledge_stat`
		    , `statistiks`.`moral_stat`
		    , `statistiks`.`sks_stat`
		    , `statistiks`.`tugas_ambil_count`
		FROM
		    `yzjvincb_kuliahku`.`statistiks`
		    INNER JOIN `yzjvincb_kuliahku`.`users` 
			ON (`statistiks`.`user_id` = `users`.`id`)
		WHERE u_email=p_email;
	ELSE
		SELECT -1, 'Email tidak terdaftar';
	END IF;
    END$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `fn_EN`$$
CREATE FUNCTION `fn_EN` (`p_EN_s0` TINYINT, `p_EN_t0` DATETIME) RETURNS TINYINT(4) BEGIN
		SELECT `EN_v`, `EN_durasi_in_sec`, `EN_max` FROM _setting
			INTO @EN_v, @EN_durasi_in_sec, @EN_max;
		
		SET @EN = p_EN_s0 + (@EN_v/@EN_durasi_in_sec) 
			* (TIMEDIFF( NOW(), p_EN_t0));
		
		IF (@EN > @EN_max) THEN
			SET @EN = @EN_max;
		END IF;
	RETURN @EN;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `caras`
--

DROP TABLE IF EXISTS `caras`;
CREATE TABLE `caras` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_tugas` int(10) UNSIGNED NOT NULL,
  `knowledge_juml` int(11) NOT NULL,
  `moral_juml` int(11) NOT NULL,
  `energi_req` int(11) NOT NULL,
  `completion_time` int(11) NOT NULL,
  `nama_cara` tinyint(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `caras`
--

INSERT INTO `caras` (`id`, `id_tugas`, `knowledge_juml`, `moral_juml`, `energi_req`, `completion_time`, `nama_cara`) VALUES
(1, 1, 30, 30, 20, 10, 1),
(2, 1, 10, 10, 5, 5, 2),
(3, 2, 50, 40, 30, 10, 1),
(4, 2, 20, 10, 10, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliahs`
--

DROP TABLE IF EXISTS `mata_kuliahs`;
CREATE TABLE `mata_kuliahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_matkul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks_juml` int(11) NOT NULL,
  `knowledge_juml` int(11) NOT NULL,
  `energi_req` int(11) NOT NULL,
  `tugas_count_req` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_kuliahs`
--

INSERT INTO `mata_kuliahs` (`id`, `nama_matkul`, `sks_juml`, `knowledge_juml`, `energi_req`, `tugas_count_req`) VALUES
(1, 'PBO', 3, 100, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_03_032219_create_mata_kuliahs_table', 1),
(4, '2017_05_03_032627_create_tugas_table', 1),
(5, '2017_05_03_032724_create_caras_table', 1),
(6, '2017_05_03_033118_create_statistiks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistiks`
--

DROP TABLE IF EXISTS `statistiks`;
CREATE TABLE `statistiks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `knowledge_stat` int(11) NOT NULL,
  `moral_stat` int(11) NOT NULL,
  `sks_stat` int(11) NOT NULL,
  `tugas_ambil_count` int(11) NOT NULL,
  `energi_stat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

DROP TABLE IF EXISTS `tugas`;
CREATE TABLE `tugas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_tugas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_tugas`) VALUES
(1, 'Pemrogaman C'),
(2, 'Pemrogaman Objek');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `u_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_name`, `u_email`, `u_password`, `remember_token`) VALUES
(1, 'pentol', 'a@a.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL),
(2, 'rogo', 'rogo@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL),
(3, 'hendry', 'hendry@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_matkul`
--

DROP TABLE IF EXISTS `user_matkul`;
CREATE TABLE `user_matkul` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `matkul_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_tugas`
--

DROP TABLE IF EXISTS `user_tugas`;
CREATE TABLE `user_tugas` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `id_tugas` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caras`
--
ALTER TABLE `caras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caras_id_tugas_foreign` (`id_tugas`);

--
-- Indexes for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `statistiks`
--
ALTER TABLE `statistiks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statistiks_user_id_foreign` (`user_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`u_email`);

--
-- Indexes for table `user_matkul`
--
ALTER TABLE `user_matkul`
  ADD KEY `matkul_user` (`matkul_id`),
  ADD KEY `user_matkul` (`user_id`);

--
-- Indexes for table `user_tugas`
--
ALTER TABLE `user_tugas`
  ADD KEY `tugas_user` (`id_tugas`),
  ADD KEY `user_tugas` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caras`
--
ALTER TABLE `caras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `statistiks`
--
ALTER TABLE `statistiks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `caras`
--
ALTER TABLE `caras`
  ADD CONSTRAINT `caras_id_tugas_foreign` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `statistiks`
--
ALTER TABLE `statistiks`
  ADD CONSTRAINT `statistiks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_matkul`
--
ALTER TABLE `user_matkul`
  ADD CONSTRAINT `matkul_user` FOREIGN KEY (`matkul_id`) REFERENCES `mata_kuliahs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_matkul` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tugas`
--
ALTER TABLE `user_tugas`
  ADD CONSTRAINT `tugas_user` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tugas` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

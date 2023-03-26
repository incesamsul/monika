
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'ketua', '2023-03-25 19:25:09', '2023-03-25 19:25:09'),
(3, 'hakim', '2023-03-25 19:28:19', '2023-03-25 19:29:58'),
(4, 'wakil', '2023-03-25 19:31:49', '2023-03-25 19:31:49'),
(5, 'iT', '2023-03-25 19:31:56', '2023-03-25 19:31:56'),
(6, 'Keuangan', '2023-03-25 19:32:03', '2023-03-25 19:32:03');





INSERT INTO `profile` (`id_profile`, `id_user`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nisn`, `alamat`, `no_telp`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `tahun_masuk`, `tahun_lulus`, `no_ijazah`, `no_skhun`, `created_at`, `updated_at`) VALUES
(1, 1, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23'),
(2, 3, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23'),
(3, 2, 'L', 'jl;', '2021-11-26', 'jlkjlj', 'ljlj', 'jl', 'jlj', 'ljl', 'jljl', 'jlkjl', 2000, 2000, 'jlkjlkj', 'lkjl', '2021-11-24 11:34:44', '2021-11-24 11:56:23');


INSERT INTO `users` (`id`, `id_jabatan`, `name`, `email`, `email_verified_at`, `password`, `role`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin', 'admin@mail.com', NULL, '$2y$10$N6nmGrHUtLAw5/5SlPZqEehn.S5KDNDFHf1yuW184mEw5zLWhVeLm', 'Administrator', '61b5cf20cb753.jpg', NULL, '2021-11-24 09:06:43', '2021-12-11 18:29:52'),
(5, 5, 'sam', 'sam@mail.com', NULL, '$2y$10$I/TY1QbV7QuoABMZ2p679O651lnCawg71WyZxjYfcofpfg2.ro/sC', 'pegawai', '', NULL, '2023-03-25 19:36:00', '2023-03-25 19:36:00');


CREATE TABLE `barang` (
    `id` varchar(255) NOT NULL COMMENT 'Primary Key', `nama` varchar(100) NOT NULL, `deskripsi` text, `gambar` text, `stok` bigint DEFAULT NULL, `stok_awal_barang` bigint DEFAULT NULL, `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Create Time', PRIMARY KEY (`id`)
);

INSERT INTO
    `barang`
VALUES (
        '20240120223211127', 'Lorem ipsum', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ad totam quae earum.\r\n', 'storage/barang/Salted Caramel.jpg', 10, 10, '2024-01-20 06:26:38'
    ),
    (
        '20240120223223917', 'Lorem ipsum', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ad totam quae earum.', 'storage/barang/matrioshki.webp', 10, 10, '2024-01-20 06:27:00'
    ),
    (
        '20240120223339637', ' Lorem ipsum', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ad totam quae earum.', 'storage/barang/_4f1f9c8d-7025-4c6b-8061-4e16c58fdd49.jpeg', 10, 10, '2024-01-20 06:25:50'
    ),
    (
        '20240121025311338', 'TV LG 24Inc', 'TV LG 24 inci memiliki layar LED berukuran 24 inci. TV ini memiliki dimensi 64 cm x 41 cm x 12 cm, berat 5 kg, tegangan 220 volt, dan konsumsi daya 40 watt. \r\nTV LG 24 inci memiliki daya listrik yang hemat dan ekonomis. TV ini dapat digunakan di rumah atau di tempat dengan daya listrik yang rendah. \r\nBerikut adalah beberapa model TV LG 24 inci:\r\nLG 24 Inch Smart TV HD 24TQ520 / 24TQ520S HD LED WebOs WIFI HDMI USB\r\nLG LED SMART TV 24 INCH 24TQ520S Digital TV 24 MONITOR 24 24TQ520\r\nLG LED TV DIGITAL 24TL520V-PT 24 INCH MONITOR TV NEW GARANSI RESMI \r\nAnda dapat membeli TV LG 24 inci di Blibli.com, Tokopedia, Shopee, dan Lazada. \r\nTv LG apakah sudah smart TV?\r\nTV LED LG 24TL520V apakah sudah digital?\r\nApakah LG TV digital?\r\nAjukan pertanyaan lanjutan...', 'storage/barang/LG 24 Inch Smart TV 24TQ520.jpg', 1, 4, '2024-01-20 05:18:52'
    ),
    (
        '20240121025527197', 'Guitar Akustik Yamaha', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem ad totam quae earum.', 'storage/barang/ill-11.jpeg', 8, 8, '2024-01-20 06:25:30'
    ),
    (
        '20240121025711459', 'Kipas Angin Miyako', 'Miyako Memperkenalkan Produk Electric Fan atau Kipas Angin Dengan Teknologi Hemat Listrik Dengan Banyak Pilihan Model. Angin Lebih Kencang Dan Tahan Lama.', 'storage/barang/Miyako Standing.jpg', 10, 10, '2024-01-20 22:25:31'
    );

CREATE TABLE `barang_hilang` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', `barang_id` varchar(255) DEFAULT NULL, `jumlah` bigint DEFAULT NULL, `nama` varchar(255) DEFAULT NULL, `alamat` text, `no_hp` varchar(20) DEFAULT NULL, `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `barang_id` (`barang_id`), CONSTRAINT `barang_hilang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO
    `barang_hilang`
VALUES (
        1, '20240121025527197', 2, 'Zaini', 'Padang', '08244421110', '2024-01-22 15:44:40'
    ),
    (
        2, '20240121025311338', 2, 'Test', 'test', 'test', '2024-01-22 15:52:11'
    ),
    (
        3, '20240121025311338', 4, '0', '0', '0', '2024-01-22 16:09:58'
    );

CREATE TABLE `peminjaman` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', `barang_id` varchar(255) DEFAULT NULL, `nama` varchar(255) DEFAULT NULL, `jumlah` bigint DEFAULT NULL, `jumlah_awal` bigint DEFAULT NULL, `alamat` text, `no_hp` varchar(255) DEFAULT NULL, `deskripsi` text, `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `barang_id` (`barang_id`), CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`), CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO
    `peminjaman`
VALUES (
        1, '20240121025711459', 'Wahyu', 0, 4, 'Lubuk Begalung', '6282286947001', 'Di pinjam untuk 3 hari kebutuhan acara', '2024-01-20 16:43:45'
    ),
    (
        2, '20240121025527197', 'Fadil', 0, 4, 'Lubuk Begalung', '08321434243', 'Di pinjam untuk 3 hari kebutuhan acara', '2024-01-20 17:58:09'
    ),
    (
        3, '20240120223211127', 'Wahyu', 0, 3, 'Padang', '628223232001', 'Test', '2024-01-20 21:50:48'
    ),
    (
        4, '20240121025311338', 'Zaini Nijar', 0, 3, 'Padang, Lubeg', '082133333001', '-', '2024-01-20 22:02:47'
    ),
    (
        5, '20240121025311338', 'Test', 0, 5, 'Test', 'TEst', 'Test', '2024-01-20 22:18:15'
    ),
    (
        6, '20240121025311338', 'test', 3, 3, 'sfsd', 'sds', 'sds', '2024-01-22 15:20:49'
    );

CREATE TABLE `pengembalian` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', `peminjaman_id` int DEFAULT NULL, `jumlah` bigint DEFAULT NULL, `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`), KEY `peminjaman_id` (`peminjaman_id`), CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO
    `pengembalian`
VALUES (
        1, 1, 4, '2024-01-20 21:23:00'
    ),
    (
        2, 2, 2, '2024-01-20 21:28:57'
    ),
    (
        4, 2, 2, '2024-01-20 21:55:35'
    ),
    (
        5, 2, 4, '2024-01-20 21:56:53'
    ),
    (
        6, 3, 3, '2024-01-20 21:57:07'
    ),
    (
        9, 4, 3, '2024-01-20 22:25:23'
    ),
    (
        10, 5, 5, '2024-01-20 22:25:28'
    );

CREATE TABLE `users` (
    `id` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', `name` varchar(255) DEFAULT NULL, `username` varchar(255) DEFAULT NULL, `password` varchar(255) DEFAULT NULL, `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)
);

INSERT INTO
    `users`
VALUES (
        1, 'Zaini Nijar', 'admin', 'admin', '2024-01-20 22:40:47'
    );
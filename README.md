# JANJI
Saya Abdurrahman Rauf Budiman dengan NIM 2301102 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program
Tugas Praktikum 7 ini intinya untuk membangun aplikasi yang lebih terstruktur, modular, dan mudah dikelola. Ketika dipadukan dengan antarmuka pengguna web yang interaktif, OOP memfasilitasi integrasi logika backend (PHP) dengan elemen-elemen frontend. 
Tema yang saya angkat yaitu terkait film database (seperti website terkenal IMDB, Letterboxd, dan Rotten Tomatoes). Dimana user bisa mengetahui detail film-film seperti aktor, direktor, dan genrenya. Makanya nama dari project ini yaitu `IMDB Ripoff`.

Berikut penjelasan lebih lanjutnya.

## 1. ERD dan relasinya
![image](https://github.com/user-attachments/assets/cdefbb93-d80b-49d9-bab2-bebeb37b6966)

Keterangan:
Disini total tabel ada 6, yaitu Actors, Directors, Genres, Movies, Movie_actors, dan Movie_genres. Relasinya yaitu:
- Tabel movie_actors memiliki 2 kunci asing (foreign key) yang merujuk ke tabel actors dan tabel movies.
- Tabel movie_genres memiliki 2 kunci asing (foreign key) yang merujuk ke tabel genres dan tabel movies.
- Tabel movies memiliki 1 kunci asing (foreign key) yang merujuk ke tabel directors.

## 2. Penjelasan Detail tiap tabel

### 1. Actors
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `actorID`      | Identitas tabel actor (PK)             |
| `name`         | Nama aktor                             |
| `nationality`  | Asal negara aktor                      |
| `age`          | Usia aktor                             |

Keterangan:
Tabel actors ini akan menjadi foreign key pada tabel movie_actors. Saya ingin membuat aktor ini hubungannya itu Many-to-many yang artinya banyak aktor bisa main di banyak film, yang artinya dibutuhkan tabel pivot (movie_actors) agar bisa memenuhi kriteria aktor bisa main di banyak film. 

### 2. Directors
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `directorID`   | Identitas tabel direktor (PK)          |
| `name`         | Nama direktor                          |
| `nationality`  | Asal negara direktor                   |
| `age`          | Usia direktor                          |

Keterangan:
Tabel director ini akan menjadi foreign key pada tabel movies. Di tabel direktor ini hubungan relasinya cukup 1-to-1 ataupun many-to-1 karena kebanyakan film hanya disutradai oleh 1 orang aja (meskipun ada juga yang banyak sutradaranya, tetapi untuk desain saya saat ini cukup 1 film 1 direktor). 

### 3. Genres
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `genreID`      | Identitas tabel genre (PK)             |
| `genre_name`   | Nama genre                             |

Keterangan:
Tabel genre ini akan menjadi foreign key pada tabel movie_genres. Tabel ini memiliki relasi hubungan yang sama dengan tabel actor yaitu many-to-many jadi butuh tabel pivot (movie_genres) juga.

### 4. Movies
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `movieID`      | Identitas tabel movie (PK)             |
| `directorID`   | Identitas tabel direktor (FK)          |
| `title`        | Judul film                             |
| `release_date` | Rilis film kapan                       |
| `avg_rating`   | Rata rata rating                       |

Keterangan:
Tabel movie ini akan menjadi foreign key pada tabel movie_genres dan movie_actors. Tabel ini merupakan inti dari film database karena berisi informasi terkait film nya. Dan hanya di tabel movies ini lah yang bisa melakukan searching berdasarkan nama judul (title).

### 5. Movie_actors
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `id`           | Identitas tabel movie_actors (PK)      |
| `movieID`      | Identitas tabel movies (FK)            |
| `actorID`      | Identitas tabel actors (FK)            |
| `role_name`    | Nama peran pada film                   |

Keterangan:
Tabel movie_actors ini disebut sebagai tabel pivot, karena digunakan untuk menyusun data agar lebih terstruktur dan mudah dibaca. Seperti yang sudah dijelaskan sebelumnya, satu aktor bisa memainkan peran di banyak film. Nah, dengan adanya tabel pivot ini, kita bisa melihat hubungan tersebut secara lebih jelas—setiap aktor akan terlihat memiliki beberapa film yang pernah diperankannya.

### 6. Movie_genres
Berikut isi atribut serta deskripsinya
| Atribut        | Deskripsi                              |
|----------------|----------------------------------------|
| `id`           | Identitas tabel movie_actors (PK)      |
| `movieID`      | Identitas tabel movies (FK)            |
| `genreID`      | Identitas tabel genres (FK)            |

Keterangan:
Sama dengan tabel movie_actors, tapi yang membedakannya ini relasinya dengan genres, bukan actor. Misal 1 film bisa banyak genres (The Raid genrenya bisa action bisa juga thriller).

## 3. Struktur project
![image](https://github.com/user-attachments/assets/d1f23b09-eb63-4539-86f9-417ba6c618b6)

Bisa terlihat bahwa project sudah termodularisasikan dan lebih terstruktur bentukannya. Berikut penjelasan tiap folder:
- Folder class sebagai controller atau yang mengatur logika pada folder view.
- Folder config sebagai konfigurasi web app nya
- Folder database sebagai tempat penyimpanan file sql nya
- Folder view sebagai bentukan visualnya pada tiap class dan tempat html modularnya juga

# Bukti Spesifikasi
Di spesifikasikan bahwa kalau bisa menggunakan PDO (PHP Document Object) dan prepared statement

Berikut contoh buktinya (misal pada class direktor.php):
![image](https://github.com/user-attachments/assets/6c697d9d-80df-46b6-ae1c-8b2062888649)

Keterangan:
- Fungsi `getAllDirectors()` menggunakan `query()` untuk mengambil semua data dari tabel directors.
- Fungsi `addDirector()` menggunakan `prepare()` dan `execute(`) untuk menambahkan data baru ke tabel directors secara aman, dengan parameter terpisah dari query SQL.

# Alur Program
Pertama tama kita pastikan server Apache dan MySQL menyala, lalu buka browser dan di url nya itu ditujukan ke index.php. Setelah muncul visualisasinya, di index.php (halaman utama) ada judul dan 4 menu tiap tabel. Ketika salah satu menu diklik, user akan diarahkan ke halaman yang sesuai dengan tabel database yang berkaitan dengan menu tersebut. Di tiap page terdapat tabel isi datanya dan operasi CRUD (Create Read Update Delete) terkait class/tabel pada database masing masing. Dan pada menu `movies` itu akan mengexpand dan muncul menu baru yaitu `movie_actors` dan `movie_genres`. Di page movies ini selain mengoperasikan CRUD, bisa juga melakukan searching berdasarkan judul film (title).

# Rekaman
https://github.com/user-attachments/assets/c05c5f3c-e599-4269-9731-f0b1d01a59b0



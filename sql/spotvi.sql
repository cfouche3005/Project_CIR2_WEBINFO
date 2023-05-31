------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
	id_user       SERIAL NOT NULL ,
	mail_user     VARCHAR (100) NOT NULL ,
	nom_user      VARCHAR (150) NOT NULL ,
	prenom_user   VARCHAR (100) NOT NULL ,
	age_user      INT  NOT NULL ,
	mdp_user      VARCHAR (150) NOT NULL ,
	pseudo_user   VARCHAR (100) NOT NULL ,
	photo_user    VARCHAR (5000) NOT NULL  ,
	CONSTRAINT User_PK PRIMARY KEY (id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Artist
------------------------------------------------------------
CREATE TABLE public.Artist(
	id_artist         VARCHAR (50) NOT NULL ,
	pseudo_artist     VARCHAR (100) NOT NULL ,
	name_info         VARCHAR (200) NOT NULL ,
	biographie_lien   VARCHAR (1000) NOT NULL ,
	photo_artist      VARCHAR (5000) NOT NULL  ,
	CONSTRAINT Artist_PK PRIMARY KEY (id_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Album
------------------------------------------------------------
CREATE TABLE public.Album(
	id_album      VARCHAR (50) NOT NULL ,
	nom_album     VARCHAR (100) NOT NULL ,
	date_album    DATE  NOT NULL ,
	image_album   VARCHAR (500) NOT NULL  ,
	CONSTRAINT Album_PK PRIMARY KEY (id_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Music
------------------------------------------------------------
CREATE TABLE public.Music(
	id_music      VARCHAR (50) NOT NULL ,
	lien_music    VARCHAR (500) NOT NULL ,
	title_music   VARCHAR (500) NOT NULL ,
	time_music    INT  NOT NULL ,
	place_album   INT  NOT NULL  ,
	CONSTRAINT Music_PK PRIMARY KEY (id_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Playlist
------------------------------------------------------------
CREATE TABLE public.Playlist(
	id_playlist     SERIAL NOT NULL ,
	nom_playlist    VARCHAR (100) NOT NULL ,
	date_creation   DATE  NOT NULL ,
	id_user         INT  NOT NULL  ,
	CONSTRAINT Playlist_PK PRIMARY KEY (id_playlist)

	,CONSTRAINT Playlist_User_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Type_music
------------------------------------------------------------
CREATE TABLE public.Type_music(
	type_music   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Type_music_PK PRIMARY KEY (type_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Type_artist
------------------------------------------------------------
CREATE TABLE public.Type_artist(
	type_artist   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Type_artist_PK PRIMARY KEY (type_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Type_album
------------------------------------------------------------
CREATE TABLE public.Type_album(
	type_album   VARCHAR (100) NOT NULL  ,
	CONSTRAINT Type_album_PK PRIMARY KEY (type_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Compose
------------------------------------------------------------
CREATE TABLE public.Compose(
	id_artist   VARCHAR (50) NOT NULL ,
	id_album    VARCHAR (50) NOT NULL ,
	id_music    VARCHAR (50) NOT NULL  ,
	CONSTRAINT Compose_PK PRIMARY KEY (id_artist,id_album,id_music)

	,CONSTRAINT Compose_Artist_FK FOREIGN KEY (id_artist) REFERENCES public.Artist(id_artist)
	,CONSTRAINT Compose_Album0_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
	,CONSTRAINT Compose_Music1_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Contient
------------------------------------------------------------
CREATE TABLE public.Contient(
	id_album   VARCHAR (50) NOT NULL ,
	id_music   VARCHAR (50) NOT NULL  ,
	CONSTRAINT Contient_PK PRIMARY KEY (id_album,id_music)

	,CONSTRAINT Contient_Album_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
	,CONSTRAINT Contient_Music0_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Possede
------------------------------------------------------------
CREATE TABLE public.Possede(
	id_music      VARCHAR (50) NOT NULL ,
	id_playlist   INT  NOT NULL ,
	date_modif    DATE  NOT NULL  ,
	CONSTRAINT Possede_PK PRIMARY KEY (id_music,id_playlist)

	,CONSTRAINT Possede_Music_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
	,CONSTRAINT Possede_Playlist0_FK FOREIGN KEY (id_playlist) REFERENCES public.Playlist(id_playlist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Appartient3
------------------------------------------------------------
CREATE TABLE public.Appartient3(
	type_music   VARCHAR (100) NOT NULL ,
	id_music     VARCHAR (50) NOT NULL  ,
	CONSTRAINT Appartient3_PK PRIMARY KEY (type_music,id_music)

	,CONSTRAINT Appartient3_Type_music_FK FOREIGN KEY (type_music) REFERENCES public.Type_music(type_music)
	,CONSTRAINT Appartient3_Music0_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Appartient
------------------------------------------------------------
CREATE TABLE public.Appartient(
	type_artist   VARCHAR (100) NOT NULL ,
	id_artist     VARCHAR (50) NOT NULL  ,
	CONSTRAINT Appartient_PK PRIMARY KEY (type_artist,id_artist)

	,CONSTRAINT Appartient_Type_artist_FK FOREIGN KEY (type_artist) REFERENCES public.Type_artist(type_artist)
	,CONSTRAINT Appartient_Artist0_FK FOREIGN KEY (id_artist) REFERENCES public.Artist(id_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Appartient2
------------------------------------------------------------
CREATE TABLE public.Appartient2(
	type_album   VARCHAR (100) NOT NULL ,
	id_album     VARCHAR (50) NOT NULL  ,
	CONSTRAINT Appartient2_PK PRIMARY KEY (type_album,id_album)

	,CONSTRAINT Appartient2_Type_album_FK FOREIGN KEY (type_album) REFERENCES public.Type_album(type_album)
	,CONSTRAINT Appartient2_Album0_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
)WITHOUT OIDS;




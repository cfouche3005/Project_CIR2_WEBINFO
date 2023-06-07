------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: User
------------------------------------------------------------
CREATE TABLE public.User(
                            id_user          VARCHAR (50) NOT NULL ,
                            mail_user        VARCHAR (100) NOT NULL ,
                            nom_user         VARCHAR (150) NOT NULL ,
                            prenom_user      VARCHAR (100) NOT NULL ,
                            date_naissance   DATE  NOT NULL ,
                            mdp_user         VARCHAR (150) NOT NULL ,
                            pseudo_user      VARCHAR (100) NOT NULL ,
                            photo_user       VARCHAR (5000) NOT NULL  ,
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
                                id_user         VARCHAR (50) NOT NULL  ,
                                CONSTRAINT Playlist_PK PRIMARY KEY (id_playlist)

    ,CONSTRAINT Playlist_User_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Genre_music
------------------------------------------------------------
CREATE TABLE public.Genre_music(
                                   genre_music_val   VARCHAR (100) NOT NULL  ,
                                   CONSTRAINT Genre_music_PK PRIMARY KEY (genre_music_val)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Type_artist
------------------------------------------------------------
CREATE TABLE public.Type_artist(
                                   type_artist_val   VARCHAR (100) NOT NULL  ,
                                   CONSTRAINT Type_artist_PK PRIMARY KEY (type_artist_val)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Type_album
------------------------------------------------------------
CREATE TABLE public.Type_album(
                                  type_album_val   VARCHAR (100) NOT NULL  ,
                                  CONSTRAINT Type_album_PK PRIMARY KEY (type_album_val)
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
-- Table: music_appartient_genre
------------------------------------------------------------
CREATE TABLE public.music_appartient_genre(
                                              genre_music_val   VARCHAR (100) NOT NULL ,
                                              id_music          VARCHAR (50) NOT NULL  ,
                                              CONSTRAINT music_appartient_genre_PK PRIMARY KEY (genre_music_val,id_music)

    ,CONSTRAINT music_appartient_genre_Genre_music_FK FOREIGN KEY (genre_music_val) REFERENCES public.Genre_music(genre_music_val)
    ,CONSTRAINT music_appartient_genre_Music0_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: artist_appartient_type
------------------------------------------------------------
CREATE TABLE public.artist_appartient_type(
                                              type_artist_val   VARCHAR (100) NOT NULL ,
                                              id_artist         VARCHAR (50) NOT NULL  ,
                                              CONSTRAINT artist_appartient_type_PK PRIMARY KEY (type_artist_val,id_artist)

    ,CONSTRAINT artist_appartient_type_Type_artist_FK FOREIGN KEY (type_artist_val) REFERENCES public.Type_artist(type_artist_val)
    ,CONSTRAINT artist_appartient_type_Artist0_FK FOREIGN KEY (id_artist) REFERENCES public.Artist(id_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: album_appartient_type
------------------------------------------------------------
CREATE TABLE public.album_appartient_type(
                                             type_album_val   VARCHAR (100) NOT NULL ,
                                             id_album         VARCHAR (50) NOT NULL  ,
                                             CONSTRAINT album_appartient_type_PK PRIMARY KEY (type_album_val,id_album)

    ,CONSTRAINT album_appartient_type_Type_album_FK FOREIGN KEY (type_album_val) REFERENCES public.Type_album(type_album_val)
    ,CONSTRAINT album_appartient_type_Album0_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: compose_album
------------------------------------------------------------
CREATE TABLE public.compose_album(
                                     id_album    VARCHAR (50) NOT NULL ,
                                     id_artist   VARCHAR (50) NOT NULL  ,
                                     CONSTRAINT compose_album_PK PRIMARY KEY (id_album,id_artist)

    ,CONSTRAINT compose_album_Album_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
    ,CONSTRAINT compose_album_Artist0_FK FOREIGN KEY (id_artist) REFERENCES public.Artist(id_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: compose_music
------------------------------------------------------------
CREATE TABLE public.compose_music(
                                     id_music    VARCHAR (50) NOT NULL ,
                                     id_artist   VARCHAR (50) NOT NULL  ,
                                     CONSTRAINT compose_music_PK PRIMARY KEY (id_music,id_artist)

    ,CONSTRAINT compose_music_Music_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
    ,CONSTRAINT compose_music_Artist0_FK FOREIGN KEY (id_artist) REFERENCES public.Artist(id_artist)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: derniere_ecoute
------------------------------------------------------------
CREATE TABLE public.derniere_ecoute(
                                       id_music       VARCHAR (50) NOT NULL ,
                                       id_user        VARCHAR (50) NOT NULL ,
                                       date_ecoute    DATE  NOT NULL ,
                                       heure_ecoute   TIMETZ  NOT NULL  ,
                                       CONSTRAINT derniere_ecoute_PK PRIMARY KEY (id_music,id_user)

    ,CONSTRAINT derniere_ecoute_Music_FK FOREIGN KEY (id_music) REFERENCES public.Music(id_music)
    ,CONSTRAINT derniere_ecoute_User0_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: aime_album
------------------------------------------------------------
CREATE TABLE public.aime_album(
                                  id_album   VARCHAR (50) NOT NULL ,
                                  id_user    VARCHAR (50) NOT NULL  ,
                                  CONSTRAINT aime_album_PK PRIMARY KEY (id_album,id_user)

    ,CONSTRAINT aime_album_Album_FK FOREIGN KEY (id_album) REFERENCES public.Album(id_album)
    ,CONSTRAINT aime_album_User0_FK FOREIGN KEY (id_user) REFERENCES public.User(id_user)
)WITHOUT OIDS;

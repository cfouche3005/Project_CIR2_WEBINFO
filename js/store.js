class UserStore {

  static get isconnected() {
    return window.sessionStorage.getItem("loginstatus") || false;
  };

   static get userdata() {
    return JSON.parse(window.sessionStorage.getItem("user")) || false;
  };

  static #validateUserdata(inputdata) {
    if (inputdata.id_user!=null && inputdata.mail_user!=null && inputdata.nom_user!=null && inputdata.prenom_user!=null && inputdata.date_naissance!=null && inputdata.mdp_user!=null && inputdata.pseudo_user!=null && inputdata.photo_user!=null) {
      return true;
    }else{
      return false;
    }
  };

  static SetUserData(inputdata) {
    if (this.#validateUserdata(inputdata[0])) {
      console.log("Valid userdata");
      window.sessionStorage.removeItem("user");
      window.sessionStorage.setItem("user",JSON.stringify(inputdata[0]));
      window.sessionStorage.removeItem("loginstatus");
      window.sessionStorage.setItem("loginstatus",true);
      return true;
    }else{
      console.log("Invalid userdata");
      return false;
    }
  };
}

class ComponentStore {
  static formatTime(time) {
    let minutes = Math.floor(time / 60);
    let seconds = Math.floor(time % 60);
    seconds = seconds < 10 ? "0" + seconds : seconds;
    return minutes + ":" + seconds;
}

  static #musiccard_album_html(trackid,trackplace,trackname,trackartists,trackduration) {
    const firstpart = `<div class="titre" id="`+trackid+`_track">
                        <p id="`+trackid+`_trackplace" class="card-title ps-1 align-self-center">`+trackplace+`</p>
                        <p id="`+trackid+`_trackname" class="card-title ps-4 align-self-center">`+trackname+`</p>
                        <p id="`+trackid+`_trackartists" class="d-flex flex-row card-title ps-4 align-self-center" style="color: #858585!important;">`;

    let secondpart =``;

    trackartists.forEach((artist) => {
      secondpart += `|<span id="`+trackid+`_trackartist_`+artist.id_artist+`" class="">`+artist.pseudo_artist+`</span>`;
    });
    secondpart += `|</p>`

    const thirdpart = `<p class="card-title ps-4 align-self-center" style="color: #858585!important;"><i class="bi bi-clock"></i></p>
                        <p id="`+trackid+`_trackduration" class="card-title ps-1 align-self-center" style="color: #858585!important;">`+this.formatTime(trackduration)+`</p>
                        <button id="`+trackid+`_trackplay" type="submit" class="ms-auto p-2 button_bot"><i class="bi bi-play-fill"></i></button>
                        <button id="`+trackid+`_tracklike" type="submit" class="p-2 button_bot"><i class="bi bi-heart"></i></button>
                        <button type="submit" class="p-2 button_bot"><i class="bi bi-plus"></i></button>
                        </div>`
    
    return firstpart+secondpart+thirdpart;
  };

  static #musiccard_album_eventlisten(trackid,trackartists,trackojb) {

    $(`#`+trackid+`_trackplay`).click((e) => {
      e.preventDefault();
      console.log("Play clicked : "+trackid);
      const playmusic = new CustomEvent('playmusic', {detail: {track: trackojb}});
      window.parent.document.dispatchEvent(playmusic);
    });

    $(`#`+trackid+`_tracklike`).click((e) => {
      e.preventDefault();
      console.log("Play clicked : "+trackid);
      const playmusic = new CustomEvent('playmusic', {detail: {track: trackojb}});
      window.parent.document.dispatchEvent(playmusic);
    });

    trackartists.forEach((artist) => {
      $(`#`+trackid+`_trackartist_`+artist.id_artist).click((e) => {
        e.preventDefault();
        console.log("Artist clicked : "+artist.id_artist);
        const pagechange = new CustomEvent('pagechange', {detail: {href: '#/content/artist/$'+artist.id_artist}});
        window.parent.document.dispatchEvent(pagechange);
      });
    });
  };

  static cleanAlbumPage(div_cover,div_name,div_artist,div_date,div_type,div_tracks) {
    $(div_cover).attr("src","");
    $(div_name).html("");
    $(div_artist).html("");
    $(div_date).html("");
    $(div_type).html("");
    $(div_tracks).html("");
  }

  static displayAlbumPage(div_cover,div_name,div_artist,div_date,div_type,div_tracks,albumdata,div_albumplay,div_add) {
      console.log(albumdata.album[0].nom_album)
      
      $(div_cover).attr("src",albumdata.album[0].image_album);
      $(div_name).html(`<span>Nom album : </span><span id="`+albumdata.album[0].id_album+`_albumname" style="font-size: larger;">`+albumdata.album[0].nom_album+`</span>`);

      $(div_artist).html(`<span>Artiste : </span><span id="`+albumdata.album[0].id_album+`_albumartist_`+albumdata.album[0].id_artist+`" style="font-size: larger;">`+albumdata.album[0].pseudo_artist+`</span>`);
      $(`#`+albumdata.album[0].id_album+`_albumartist_`+albumdata.album[0].id_artist).click((e) => {
        e.preventDefault();
        console.log("Artist clicked : "+albumdata.album[0].id_artist);
        const pagechange = new CustomEvent('pagechange', {detail: {href: '#/content/artist/$'+albumdata.album[0].id_artist}});
        window.parent.document.dispatchEvent(pagechange);
      });

      $(div_date).html(`<span>Date de sortie : </span><span id="`+albumdata.album[0].id_album+`_albumdate" style="font-size: larger;">`+albumdata.album[0].date_album+`</span>`);
      $(div_type).html(`<span>Type : </span><span id="`+albumdata.album[0].id_album+`_albumtype" style="font-size: larger;">`+albumdata.album[0].type_album_val+`</span>`);
      $(div_tracks).html(``);

      albumdata.musics.forEach((track) => {
        $(div_tracks).append(this.#musiccard_album_html(track.id_music,track.place_album,track.title_music,track.artists,track.time_music));
        this.#musiccard_album_eventlisten(track.id_music,track.artists,track);
      });

      $(div_albumplay).click((e) => {
        e.preventDefault();
        console.log("Play clicked : "+albumdata.album[0].id_album);
        const playalbum = new CustomEvent('playalbum', {detail: {album: albumdata}});
        window.parent.document.dispatchEvent(playalbum);
      });

      $(div_add).click((e) => {
        e.preventDefault();
        console.log("Like clicked : "+albumdata.album[0].id_album);
        const likealbum = new CustomEvent('likealbum', {detail: {album: albumdata}});
        window.parent.document.dispatchEvent(likealbum);
      });

  };

  static #album_card_html(album_id,album_cover,album_name,album_artist,id_artist) {
    const firstpart = `<div id="`+album_id+`_card" class="card m-4" style="min-width: 200px; max-width: 200px; background-color: #454545!important; color: white!important;"><img id="`+album_id+`_img" src="`+album_cover+`" class="card-img-top img-fluid img-thumbnail align-self-center" style="width: 95%; margin-top: 3%" alt="album_cover"><div class="card-body align-self-center"><button id="`+album_id+`_title" class="card-title card-button h6">`+album_name+`</button><p class="card-text small"><span id="`+album_id+`_albumartist_`+id_artist+`" class="">`+album_artist+`</span></p></div></div></div>`;
    return firstpart;

  };

  static #album_card_eventlisten(album_id,album_artist,id_artist) {
      
      $(`#`+album_id+`_title`).click((e) => {
        e.preventDefault();
        console.log("Album clicked : "+album_id);
        window.parent.location.hash = '#/content/album/$'+album_id
        //window.parent.document.dispatchEvent(new CustomEvent('pagechange', {detail: {href: '#/content/album/$'+album_id}}));
      });
  
      
      $(`#`+album_id+`_albumartist_`+id_artist).click((e) => {
        e.preventDefault();
        console.log("Artist clicked : "+album_artist +"href"+ location.href );
        window.parent.location.hash = '#/content/artist/$'+id_artist
        //window.parent.document.dispatchEvent(new CustomEvent('pagechange', {detail: {href: '#/content/artist/$'+id_artist}}));
      });
  
    };
    static displayAlbumHome(div_albums,albumsdata) {
      $(div_albums).html(``);
      albumsdata.forEach((album) => {
        $(div_albums).append(this.#album_card_html(album.id_album,album.image_album,album.nom_album,album.pseudo_artist,album.id_artist));
        this.#album_card_eventlisten(album.id_album,album.pseudo_artist,album.id_artist);
      });
    };

    static #playlist_card_html(playlist_id,playlist_cover,playlist_name,playlist_datemodif) {
      const firstpart = `<div id="`+playlist_id+`_card" class="card m-4" style="min-width: 200px; max-width: 200px; background-color: #454545!important; color: white!important;"><img id="`+playlist_id+`_img" src="`+playlist_cover+`" class="card-img-top img-fluid img-thumbnail align-self-center" style="width: 95%; margin-top: 3%" alt="album_cover"><div class="card-body align-self-center"><button id="`+playlist_id+`_title" class="card-title card-button h6">`+playlist_name+`</button><p class="card-text small"><span id="`+playlist_id+`_datemodif" class="">`+playlist_datemodif+`</span></p></div></div></div>`;
      return firstpart;
  
    };

    static #playlist_card_eventlisten(playlist_id) {
      
      $(`#`+playlist_id+`_title`).click((e) => {
        e.preventDefault();
        console.log("Playlist clicked : "+playlist_id);
        window.parent.location.hash = '#/content/playlist/$'+playlist_id
        //window.parent.document.dispatchEvent(new CustomEvent('pagechange', {detail: {href: '#/content/album/$'+album_id}}));
      });

    };

    static displayPlaylistLibrary(div_playlists,playlistsdata) {
      $(div_playlists).html(``);
      playlistsdata.forEach((playlist) => {
        $(div_playlists).append(this.#playlist_card_html(playlist.id_playlist,'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp',playlist.nom_playlist,playlist.date_modif));
        this.#playlist_card_eventlisten(playlist.id_playlist);
      });
    };

    static displayAlbumLibrary(div_albums,albumsdata) {
      $(div_albums).html(``);
      albumsdata.forEach((album) => {
        $(div_albums).append(this.#album_card_html(album.id_album,album.image_album,album.nom_album,album.pseudo_artist,album.id_artist));
        this.#album_card_eventlisten(album.id_album,album.pseudo_artist,album.id_artist);
      });
    };

    static #musiccard_playlist_html(trackid,trackname,trackartists,trackduration) {
      const firstpart = `<div class="titre" id="`+trackid+`_track">
                          <p id="`+trackid+`_trackname" class="card-title ps-4 align-self-center">`+trackname+`</p>
                          <p id="`+trackid+`_trackartists" class="d-flex flex-row card-title ps-4 align-self-center" style="color: #858585!important;">`;
  
      let secondpart =``;
  
      trackartists.forEach((artist) => {
        secondpart += `|<span id="`+trackid+`_trackartist_`+artist.id_artist+`" class="">`+artist.pseudo_artist+`</span>`;
      });
      secondpart += `|</p>`
  
      const thirdpart = `<p class="card-title ps-4 align-self-center" style="color: #858585!important;"><i class="bi bi-clock"></i></p>
                          <p id="`+trackid+`_trackduration" class="card-title ps-1 align-self-center" style="color: #858585!important;">`+this.formatTime(trackduration)+`</p>
                          <button id="`+trackid+`_trackplay" type="submit" class="ms-auto p-2 button_bot"><i class="bi bi-play-fill"></i></button>
                          <button id="`+trackid+`_tracklike" type="submit" class="p-2 button_bot"><i class="bi bi-heart"></i></button>
                          <button type="submit" class="p-2 button_bot"><i class="bi bi-plus"></i></button>
                          </div>`
      
      return firstpart+secondpart+thirdpart;
    };

    static #musiccard_playlist_eventlisten(trackid,trackartists,trackojb) {

      $(`#`+trackid+`_trackplay`).click((e) => {
        e.preventDefault();
        console.log("Play clicked : "+trackid);
        const playmusic = new CustomEvent('playmusic', {detail: {track: trackojb}});
        window.parent.document.dispatchEvent(playmusic);
      });
  
      $(`#`+trackid+`_tracklike`).click((e) => {
        e.preventDefault();
        console.log("Play clicked : "+trackid);
        const playmusic = new CustomEvent('playmusic', {detail: {track: trackojb}});
        window.parent.document.dispatchEvent(playmusic);
      });
  
      trackartists.forEach((artist) => {
        $(`#`+trackid+`_trackartist_`+artist.id_artist).click((e) => {
          e.preventDefault();
          console.log("Artist clicked : "+artist.id_artist);
          const pagechange = new CustomEvent('pagechange', {detail: {href: '#/content/artist/$'+artist.id_artist}});
          window.parent.document.dispatchEvent(pagechange);
        });
      });
    };

    static cleanPlaylistPage(div_cover,div_name,div_createur,div_datecrea,div_datemodif,div_tracks) {
      $(div_cover).attr("src","");
      $(div_name).html("");
      $(div_createur).html("");
      $(div_datecrea).html("");
      $(div_datemodif).html("");
      $(div_tracks).html("");
    }

    static displayplaylistPage(div_cover,div_name,div_createur,div_datecrea,div_datemodif,div_tracks,playlistdata,div_playlistplay,div_add) {
      console.log(playlistdata.playlist[0].nom_playlist)
      $(div_cover).attr("src",'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp');
      $(div_name).html(`<span>Nom Playlist : </span><span id="`+playlistdata.playlist[0].id_playlist+`_playlistname" style="font-size: larger;">`+playlistdata.playlist[0].nom_playlist+`</span>`);

      $(div_createur).html(`<span>Créateur : </span><span id="`+playlistdata.playlist[0].id_playlist+`_playlistartist_`+UserStore.userdata.id_user+`" style="font-size: larger;">`+UserStore.userdata.pseudo_user+`</span>`);
      // $(`#`+playlistdata.playlist[0].id_playlist+`_albumartist_`+playlistdata.playlist[0].id_artist).click((e) => {
      //   e.preventDefault();
      //   console.log("Artist clicked : "+playlistdata.playlist[0].id_artist);
      //   const pagechange = new CustomEvent('pagechange', {detail: {href: '#/content/artist/$'+playlistdata.playlist[0].id_artist}});
      //   window.parent.document.dispatchEvent(pagechange);
      // });

      $(div_datecrea).html(`<span>Date de création : </span><span id="`+playlistdata.playlist[0].id_playlist+`_playlistcreadate" style="font-size: larger;">`+playlistdata.playlist[0].date_creation+`</span>`);
      $(div_datemodif).html(`<span>Date de modification : </span><span id="`+playlistdata.playlist[0].id_playlist+`_playlistmodifdate" style="font-size: larger;">`+playlistdata.playlist[0].date_modif+`</span>`);
      $(div_tracks).html(``);

      playlistdata.musics.forEach((track) => {
        $(div_tracks).append(this.#musiccard_playlist_html(track.id_music,track.title_music,track.artists,track.time_music));
        this.#musiccard_playlist_eventlisten(track.id_music,track.artists,track);
      });

};

};

const baseurl = "http://10.10.51.73/Project_CIR2_WEBINFO/php/request.php/";

export {UserStore,ComponentStore,baseurl}

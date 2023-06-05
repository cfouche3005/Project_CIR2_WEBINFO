class UserStore {
  #loginstatus = false;
  #userdata = {};

  constructor(userdata,loginstatus=false) {
    this.#userdata = userdata;
    this.#loginstatus = loginstatus;
  };

  get isconnected() {
    return this.#loginstatus;
  };

  get userdata() {
    return this.#userdata;
  };

  #validateUserdata(inputdata) {
    if (inputdata.id_user!=null && inputdata.mail_user!=null && inputdata.nom_user!=null && inputdata.prenom_user!=null && inputdata.date_naissance!=null && inputdata.mdp_user!=null && inputdata.pseudo_user!=null && inputdata.photo_user!=null) {
      return true;
    }else{
      return false;
    }
  };

  SetUserData(inputdata) {
    if (this.#validateUserdata(inputdata)) {
      this.#userdata = userdata;
      this.#loginstatus = true;
    }else{
      console.log("Invalid userdata");
      return false;
    }
  };
}

class ComponentStore {
  static #musiccard_album(trackid,trackplace,trackname,trackartists,trackduration) {
    const firstpart = `<div id="`+trackid+`_track" class="card mx-4" >
                        <div class="card-body d-flex flex-row">
                        <h6 id="`+trackid+`_track%place" class="card-title">`+trackplace+`</h6>
                        <h6 id="`+trackid+`_track%name" class="card-title ps-4">`+trackname+`</h6>
                        <h6 id="`+trackid+`_track%artists" class="card-title ps-4 d-flex flex-row">`;

    let secondpart =``;

    trackartists.forEach((artist) => {
      secondpart += `<div id="`+trackid+`_track%artist_`+artist.id_artist+`" class="">`+artist.nom_artist+`</div>`;
    });

    const thirdpart = `</h6>
                          <h6 id="`+trackid+`_track%duration" class="card-title position-absolute end-0  pe-3">`+(trackduration-trackduration%60)+`.`+trackduration%60+`</h6>
                        </div>
                      </div>`;
    return firstpart+secondpart+thirdpart;
  };
}

const userstore = new UserStore({
  id_user: null,
  mail_user: null,
  nom_user: null,
  prenom_user: null,
  date_naissance: null,
  mdp_user: null,
  pseudo_user: null,
  photo_user: null,
},false);

export {userstore}

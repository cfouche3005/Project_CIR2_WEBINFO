class AudioPlayer{
    #audioContext
    #audioElement
    #source

    constructor() {
        this.#audioContext = new (window.AudioContext || window.webkitAudioContext ||  window.webAudioContext);
        console.log(this.#audioContext);
        this.#audioElement = document.querySelector("audio");
        console.log(this.#audioElement);
        // this.#source = this.#audioContext.createMediaElementSource(this.#audioElement);
        // console.log(this.#source);
        // this.#source.connect(this.#audioContext.destination);
        // console.log(this.#source);
        // console.log(this.#audioContext);
      }

    #addSource(src){
        this.#audioElement.src = "";
        this.#audioElement.src = src;
        this.#audioElement.load();
    }

    playNew(data){
        console.log(data);
        console.log(data.lien_music);
        this.#addSource(data.lien_music);
        console.log(this.#audioElement);
        // if (this.#audioContext.state === "suspended") {
        //     this.#audioContext.resume();
        //   }
        // this.#audioElement.play();
    }
}

export {AudioPlayer};
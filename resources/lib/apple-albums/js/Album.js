export default class Album {
    constructor(album, parentElement) {
        this._h = album.h;
        this._v = album.v;
        this._s = album.s;
        this._sprite = album.sprite.split(',');
        this._parentElement = parentElement;
        this._artworkImage = null;
        this._artworkImageAlt = null;
        this.findVacantSprite = () => {};
        this.init();
    }

    set sprite (value) {
        this._sprite = value;
    }

    get sprite () {
        return this._sprite;
    }

    get s () {
        return this._s;
    }

    init () {
        if (!this._parentElement) return;
        let artwork = document.createElement('div');
        artwork.setAttribute('data-artwork-screen-position', `${this._h},${this._v}`);
        artwork.setAttribute('data-artwork-size', this._s);
        artwork.classList.add('artwork');
        let artworkImage = document.createElement('div');
        artworkImage.classList.add('artwork-image');
        artworkImage.setAttribute('data-artwork-sprite', this._sprite);

        this._artworkImage = artworkImage;

        let artworkImageAlt = document.createElement('div');
        artworkImageAlt.classList.add('artwork-image-alt');
        artworkImageAlt.setAttribute('data-artwork-sprite', this._sprite);

        this._artworkImageAlt = artworkImageAlt;

        artwork.appendChild(artworkImage);
        artwork.appendChild(artworkImageAlt);
        this._parentElement.appendChild(artwork);
    }

    setPositionAlt (h, v) {
        this._artworkImageAlt.classList.add('active');
        this._artworkImageAlt.setAttribute('data-artwork-sprite', `${h},${v}`);
        this._artworkImageAlt.addEventListener('transitionend', () => this.setPosition(h, v), false);
    }

    setPosition (h, v) {
        this._artworkImage.setAttribute('data-artwork-sprite', `${h},${v}`);
        this._artworkImageAlt.classList.remove('active');
        this._artworkImageAlt.removeEventListener('transitionend', () => this.setPosition(h, v));
    }
}
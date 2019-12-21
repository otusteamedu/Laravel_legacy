export default class Albums {
    constructor(matrix, albums) {
        this._matrix = matrix;
        this._albums = albums;
        this._matrixState = [];
        this._windowFocus = true;
    }

    async init() {
        console.log('albums')
        if(!this._albums) return;
        await this.initMatrixState();
        await setTimeout(() => {
            this.startChangeAlbumsSprite();
        }, 4000);
        window.onblur = () => {
            this._windowFocus = false
        };
        window.onfocus = () => {
            this._windowFocus = true;
            this.startChangeAlbumsSprite();
        };
    }

    initMatrixState () {
        return this._matrix.map(cell => {
            if (this._albums.find(album => album.sprite[0] == cell[0] && album.sprite[1] == cell[1] && album.s == cell[2])) {
                this._matrixState.push({
                    h: cell[0],
                    v: cell[1],
                    s: cell[2],
                    busy: true
                });

            } else {
                this._matrixState.push({
                    h: cell[0],
                    v: cell[1],
                    s: cell[2],
                    busy: false
                });
            }
        });
    }

    startChangeAlbumsSprite() {
        if (this._windowFocus) {
            let randTimer = Math.random() * 400 + 200;
            setTimeout (async () => {
                let album = await this.getSelectedAlbum();
                let nextSprite = await this.selectNewSprite(album);
                await this.changeAlbumSprite(album, nextSprite);
                await this.startChangeAlbumsSprite();
            }, randTimer);
        }
    }

    getSelectedAlbum () {
        let selectedAlbumIndex = Math.floor(Math.random() * this._albums.length);
        return this._albums[selectedAlbumIndex];
    }

    selectNewSprite (album) {
        let nextSprite = this._matrixState.find(sprite => !sprite.busy && sprite.h != album.sprite[0] && sprite.v != album.sprite[1] && sprite.s == album.s);
        return nextSprite;
    }

    changeAlbumSprite (album, nextSprite) {
        let matrixState = this._matrixState;
        matrixState.map(sprite => {
            if (sprite.busy && sprite.h == album.sprite[0] && sprite.v == album.sprite[1]) {
                sprite.busy = false;
            } else if (!sprite.busy && sprite.h == nextSprite.h && sprite.v == nextSprite.v) {
                sprite.busy = true;
            }
        })
        this._matrixState = matrixState;
        album.sprite[0] = nextSprite.h;
        album.sprite[1] = nextSprite.v;
        album.setPositionAlt(album.sprite[0], album.sprite[1]);
    }
}

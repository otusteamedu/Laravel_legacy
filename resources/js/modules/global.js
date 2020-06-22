export const global = {
    state: {
        isObjectEmpty: (obj) => {
            for(var prop in obj) {
                if(obj.hasOwnProperty(prop))
                    return false;
            }
            return true;
        }
    },
    getters: {
        isObjectEmpty(state) {
            return state.isObjectEmpty;
        }
    }
}
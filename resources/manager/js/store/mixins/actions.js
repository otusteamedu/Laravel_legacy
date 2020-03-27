import axios from "axios";

export const axiosAction = (method, context, { url, data = null, thenContent = null, config = null }) => {
    return axios[method](url, data, config)
        .then(response => {
            if (thenContent) {
                thenContent(response);
            }
            context.commit('CLEAR_ERRORS', null, { root: true });
        })
        .catch(error => {
            context.commit('UPDATE_ERRORS', error.response, { root: true });
            throw Error;
        });
}

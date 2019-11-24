const touchMap = new WeakMap();

export const validationDelay = {
    methods: {
        setValidationDelay(v) {
            v.$reset();
            if (touchMap.has(v)) {
                clearTimeout(touchMap.get(v));
            }
            touchMap.set(v, setTimeout(v.$touch, 500));
        }
    }
}

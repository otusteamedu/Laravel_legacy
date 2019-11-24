// import { required, minLength } from 'vuelidate/lib/validators'
const touchMap = new WeakMap();

// export const titleValidation = {
//     validations: {
//         title: {
//             required,
//             touch: false,
//             minLength: minLength(2),
//             isUnique (value) {
//                 return (value.trim() === '') && !this.$v.title.$dirty
//                     ? true
//                     : !this.isUniqueTitle
//             }
//         }
//     }
// }
//
// export const titleEditValidation = {
//     validations: {
//         title: {
//             required,
//             touch: false,
//             minLength: minLength(2),
//             isUnique (value) {
//                 return (value.trim() === '') && !this.$v.title.$dirty
//                     ? true
//                     : !this.isUniqueTitleEdit
//             }
//         }
//     }
// }
//
// export const aliasValidation = {
//     validations: {
//         alias: {
//             required,
//             touch: false,
//             minLength: minLength(2),
//             isUnique (value) {
//                 return (value.trim() === '') && !this.$v.alias.$dirty
//                     ? true
//                     : !this.isUniqueAlias
//             },
//             testAlias (value) {
//                 return value.trim() === ''
//                     ? true
//                     : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
//             }
//         }
//     }
// }
//
// export const aliasEditValidation = {
//     validations: {
//         alias: {
//             required,
//             touch: false,
//             minLength: minLength(2),
//             isUnique (value) {
//                 return (value.trim() === '') && !this.$v.alias.$dirty
//                     ? true
//                     : !this.isUniqueAliasEdit
//             },
//             testAlias (value) {
//                 return value.trim() === ''
//                     ? true
//                     : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
//             }
//         }
//     }
// }

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

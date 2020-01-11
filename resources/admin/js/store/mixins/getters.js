export const uniqueFieldMixin = (items, fieldName, value) => {
    return items.find(item => item[fieldName].toLowerCase() === value.toLowerCase())
};

export const uniqueFieldEditMixin = (items, fieldName, value, id) => {
    return items.find(item => {
        if(item.id !== +id) {
            return item[fieldName].toLowerCase() === value.toLowerCase()
        }
    })
}

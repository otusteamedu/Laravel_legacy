export const getFormatPrice = price => typeof price === 'number' && price > 0
    ? price.toLocaleString('ru-Ru', {
        style: 'currency',
        currency: 'RUB',
        minimumFractionDigits: 0
    })
    : price

export const getArticle = (id) => {
    return id.toString().padStart(5, 0)
}

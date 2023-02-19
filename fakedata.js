const pets = ['貓', '狗'];
const pName = ['雞','鴨','牛','羊','魚','綜合','鮮蔬']
const items = ['玩具','籠子','領巾','食盆'];
const pClass=['罐頭','飼料','外出繩'];
const toyClasses=['披薩餅','漢堡','雞腿','沙拉','三明治','壽司','牛排','意大利麵','雞翅','洋芋片'];

// const generateRandomData = () => {
//   const pet = pets[Math.floor(Math.random() * pets.length)];
//   const toyClass = toyClasses[Math.floor(Math.random() * toyClasses.length)];
//   const item = '造型' + items[Math.floor(Math.random() * items.length)];
//   const price = Math.floor(Math.random() * 1000);
//   return `{ ${pet}, ${toyClass}${item} , ${price} }`;
// };
const generateRandomData = (id) => {
    // const pet = pets[Math.floor(Math.random() * pets.length)];
    const toyClass = toyClasses[Math.floor(Math.random() * toyClasses.length)];
    const item = '造型' + items[Math.floor(Math.random() * items.length)];
    const price = Math.floor(Math.random() * 1000);
    return {products_id: id, products_name: toyClass+item, price: price,products_unit: '1入'};
    };

const data = [];
for (let i = 1; i < 100; i++) {
  data.push(generateRandomData(i));
}
const dataArray = JSON.stringify(data)
console.log(dataArray);

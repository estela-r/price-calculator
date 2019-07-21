## Калкулатор на цени

Изчислява финална цена на продукт. Получава като входяща информация обекти, на базата на които се изчислява крайна цена. Входящите обекти са 2 типа: прост продукт или бъндъл. Бъндълът може да е съвкупност от прости продукти или комбинация от продукти и други бъндъли. 

## Пример за използване: 

```
$keyboard = new Product(‘Keyboard’, 100.45); 
$mouse = new Product(‘Mouse’, 25.68); 
$headphones = new Product(‘Headphones’, 25.68); 
$firstBundle = new ProductsBundle([$keyboard, $mouse]); 
$secondBundle = new ProductsBundle([$firstBundle, $headphones]); 

$calculator = new TotalPriceCalculator([$keyboard, $mouse, $secondBundle, $firstBundle]); 
$total = $calculator->getTotal();
```

## Installation
```
git clone
composer install
```

## Run unit tests
```
vendor\bin\phpunit tests
```
